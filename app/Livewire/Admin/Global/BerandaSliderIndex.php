<?php

namespace App\Livewire\Admin\Global;

use Livewire\Component;
use App\Traits\UploadFile;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Traits\HandleFilePond;
use App\Models\Global\Language;
use Illuminate\Support\Facades\DB;
use App\Models\Global\BerandaSlider;
use App\Services\TranslationService;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Storage;

class BerandaSliderIndex extends Component
{
    use UploadFile, Interactions, WithFileUploads, HandleFilePond;

    // Media upload
    public $media;
    public $existing_media; // For displaying existing media during edit

    // Indonesian (primary) fields
    public $title_id = '';
    public $description_id = '';

    // English fields
    public $title_en = '';
    public $description_en = '';

    // Chinese fields
    public $title_zh = '';
    public $description_zh = '';

    // Other fields
    public $sort_number = 1;
    public $sliderId = null;
    
    // Array to hold sort numbers for inline editing
    public $sortNumbers = [];
    public $uploadKey = 'default';

    protected $rules = [
        'media' => 'required|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,webm|max:10240', 
        'title_id' => 'required|string|max:255',
        'description_id' => 'required|string',
        'title_en' => 'required|string|max:255',
        'description_en' => 'required|string',
        'title_zh' => 'required|string|max:255',
        'description_zh' => 'required|string',
        'sort_number' => 'integer|min:1',
    ];

    public function render()
    {
        $sliders = BerandaSlider::with('language')->orderBy('sort_number')->get();
        
        // Initialize sortNumbers array with current values
        foreach ($sliders->where('language.code', 'id') as $slider) {
            $this->sortNumbers[$slider->id] = $slider->sort_number;
        }
        
        return view('livewire.admin.global.beranda-slider-index', compact('sliders'));
    }

    public function modalAdd()
    {
        $this->resetForm();
        // Auto-set sort_number to next available number
        $this->sort_number = BerandaSlider::max('sort_number') + 1;
        $this->js('$modalOpen("up-cr")');
    }

    public function modalEdit($id)
    {
        $slider = BerandaSlider::findOrFail($id);
        $this->sliderId = $id;
        $sortNumber = $slider->sort_number;

        // Load data for all languages with the same sort_number
        $indonesianSlider = BerandaSlider::where('sort_number', $sortNumber)
            ->where('language_id', $this->getLanguageId('id'))
            ->first();
        $englishSlider = BerandaSlider::where('sort_number', $sortNumber)
            ->where('language_id', $this->getLanguageId('en'))
            ->first();
        $chineseSlider = BerandaSlider::where('sort_number', $sortNumber)
            ->where('language_id', $this->getLanguageId('zh'))
            ->first();

        if ($indonesianSlider) {
            $this->title_id = $indonesianSlider->title;
            $this->description_id = $indonesianSlider->description;
            $this->media = Storage::url($indonesianSlider->media); 
            $this->sort_number = $indonesianSlider->sort_number;
        }

        if ($englishSlider) {
            $this->title_en = $englishSlider->title;
            $this->description_en = $englishSlider->description;
        }

        if ($chineseSlider) {
            $this->title_zh = $chineseSlider->title;
            $this->description_zh = $chineseSlider->description;
        }

        $this->js('$modalOpen("up-cr")');
        $this->uploadKeyGenerate();
    }


    public function uploadKeyGenerate()
    {
        $this->uploadKey = Str::random();
    }

    public function autoTranslateToEnglish()
    {
        if (empty($this->title_id) && empty($this->description_id)) {
            $this->toast()->error('Harap isi judul dan deskripsi bahasa Indonesia terlebih dahulu')->send();
            return;
        }

        $translationService = new TranslationService();

        if (!empty($this->title_id)) {
            $this->title_en = $translationService->translateToEnglish($this->title_id);
        }

        if (!empty($this->description_id)) {
            $this->description_en = $translationService->translateToEnglish($this->description_id);
        }

        $this->toast()->success('Terjemahan bahasa Inggris berhasil dibuat')->send();
    }

    public function autoTranslateToChinese()
    {
        if (empty($this->title_id) && empty($this->description_id)) {
            $this->toast()->error('Harap isi judul dan deskripsi bahasa Indonesia terlebih dahulu')->send();
            return;
        }

        $translationService = new TranslationService();

        if (!empty($this->title_id)) {
            $this->title_zh = $translationService->translateToChinese($this->title_id);
        }

        if (!empty($this->description_id)) {
            $this->description_zh = $translationService->translateToChinese($this->description_id);
        }

        $this->toast()->success('Terjemahan bahasa China berhasil dibuat')->send();
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $mediaPath = $this->existing_media; // Default to existing media
            if ($this->media) {
                $mediaPath = $this->saveOrUpdateFile($this->media, 'beranda-sliders');
            }

            // Get the next sort number for new entries or use existing for edits
            if ($this->sliderId) {
                // For editing, keep the existing sort_number
                $currentSlider = BerandaSlider::findOrFail($this->sliderId);
                $sortNumber = $currentSlider->sort_number;
            } else {
                // For new entries, use auto-generated sort_number
                $sortNumber = $this->sort_number ?? (BerandaSlider::max('sort_number') + 1);
            }

            // Get language IDs
            $idLangId = $this->getLanguageId('id');
            $enLangId = $this->getLanguageId('en');
            $zhLangId = $this->getLanguageId('zh');

            // Save Indonesian version
            $sliderData = [
                'title' => $this->title_id,
                'description' => $this->description_id,
                'sort_number' => $sortNumber,
                'language_id' => $idLangId,
            ];

            if ($mediaPath) {
                $sliderData['media'] = $mediaPath;
            }

            if ($this->sliderId) {
                // Update existing slider
                $slider = BerandaSlider::findOrFail($this->sliderId);
                $slider->update($sliderData);
            } else {
                // Create new slider
                $slider = BerandaSlider::create($sliderData);
            }

            // Save or update English version
            BerandaSlider::updateOrCreate(
                [
                    'sort_number' => $sortNumber,
                    'language_id' => $enLangId,
                ],
                [
                    'source_id' => $slider?->id,
                    'title' => $this->title_en,
                    'description' => $this->description_en,
                    'media' => $mediaPath,
                ]
            );

            // Save or update Chinese version
            BerandaSlider::updateOrCreate(
                [
                    'sort_number' => $sortNumber,
                    'language_id' => $zhLangId,
                ],
                [
                    'source_id' => $slider?->id,
                    'title' => $this->title_zh,
                    'description' => $this->description_zh,
                    'media' => $mediaPath,
                ]
            );

            DB::commit();

            $this->resetForm();
            $this->toast()->success($this->sliderId ? 'Slider beranda berhasil diperbarui' : 'Slider beranda berhasil ditambahkan')->send();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast()->error('Terjadi kesalahan: ' . $e->getMessage())->send();
        }
    }

    public function delete($id)
    {
        try {
            // Find the slider to get its sort_number
            $slider = BerandaSlider::findOrFail($id);
            $sortNumber = $slider->sort_number;

            // Delete all language versions of this slider
            BerandaSlider::where('sort_number', $sortNumber)->delete();

            $this->toast()->success('Slider beranda berhasil dihapus')->send();

        } catch (\Exception $e) {
            $this->toast()->error('Terjadi kesalahan: ' . $e->getMessage())->send();
        }
    }

    public function updateSortNumber($sliderId)
    {
        try {
            // Get the current Indonesian slider to retrieve its sort_number
            $currentSlider = BerandaSlider::findOrFail($sliderId);
            $oldSortNumber = $currentSlider->sort_number;

            // Update sort number across all languages
            BerandaSlider::where('sort_number', $oldSortNumber)->update([
                'sort_number' => $this->sortNumbers[$sliderId] ?? $oldSortNumber,
            ]);

            $this->toast()->success('Nomor urut slider berhasil diperbarui')->send();
        } catch (\Exception $e) {
            $this->toast()->error('Terjadi kesalahan: ' . $e->getMessage())->send();
        }
    }

    private function resetForm()
    {
        $this->title_id = '';
        $this->description_id = '';
        $this->title_en = '';
        $this->description_en = '';
        $this->title_zh = '';
        $this->description_zh = '';
        $this->sort_number = BerandaSlider::max('sort_number') + 1;
        $this->media = null;
        $this->existing_media = null;
        $this->sliderId = null;
    }

    private function getLanguageId($code)
    {
        $language = Language::where('code', $code)->first();
        return $language ? $language->id : null;
    }
}
