<x-ts-modal title="Ubah atau Buat Konten" id="up-cr" size="4xl" scrollable center>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 gap-4">
            {{-- Indonesian Section --}}
            <x-ts-card>
                <x-slot:header>
                    <div class="p-2">
                        Bahasa Indonesia (Wajib)
                    </div>
                </x-slot:header>
                <div class="grid grid-cols-1 gap-4">
                    <x-ts-upload label="Media *" wire:model="media" />
                    @if($existing_media)
                        <div class="mt-2">
                            <p class="text-sm text-gray-600 mb-2">Media saat ini:</p>
                            <img src="{{ Storage::url($existing_media) }}" alt="Current Media" class="w-32 h-32 object-cover rounded border">
                        </div>
                    @endif
                    <x-ts-input wire:model="title_id" label="Judul *" />
                    <x-ts-textarea wire:model="description_id" label="Deskripsi *" />
                </div>
            </x-ts-card>

            {{-- English Section --}}
            <x-ts-card>
                <x-slot:header>
                    <div class="p-2 flex items-center justify-between">
                        <h1>Bahasa Inggris (Wajib)</h1>
                        <x-buttons.button 
                            color="warning" 
                            iconClass="ti ti-wand" 
                            class="gap-2"
                            type="button"
                            wire:click="autoTranslateToEnglish"
                            wire:loading.attr="disabled"
                            wire:target="autoTranslateToEnglish">
                            <span wire:loading.remove wire:target="autoTranslateToEnglish">Isi otomatis</span>
                            <span wire:loading wire:target="autoTranslateToEnglish">Menerjemahkan...</span>
                        </x-buttons.button>
                    </div>
                </x-slot:header>
                <div class="grid grid-cols-1 gap-4">
                    <x-ts-input wire:model="title_en" label="Judul *" />
                    <x-ts-textarea wire:model="description_en" label="Deskripsi *" />
                </div>
            </x-ts-card>

            {{-- Chinese Section --}}
            <x-ts-card>
                <x-slot:header>
                    <div class="p-2 flex items-center justify-between">
                        <h1>Bahasa China (Wajib)</h1>
                        <x-buttons.button 
                            color="warning" 
                            iconClass="ti ti-wand" 
                            class="gap-2"
                            type="button"
                            wire:click="autoTranslateToChinese"
                            wire:loading.attr="disabled"
                            wire:target="autoTranslateToChinese">
                            <span wire:loading.remove wire:target="autoTranslateToChinese">Isi otomatis</span>
                            <span wire:loading wire:target="autoTranslateToChinese">Menerjemahkan...</span>
                        </x-buttons.button>
                    </div>
                </x-slot:header>
                <div class="grid grid-cols-1 gap-4">
                    <x-ts-input wire:model="title_zh" label="Judul *" />
                    <x-ts-textarea wire:model="description_zh" label="Deskripsi *" />
                </div>
            </x-ts-card>
        </div>

        <x-slot:footer>
            <x-buttons.button color="secondary" type="button" x-on:click="$modalClose('up-cr')">
                Batal
            </x-buttons.button>
            <x-buttons.button 
                color="primary" 
                type="submit"
                wire:loading.attr="disabled"
                wire:target="save">
                <span wire:loading.remove wire:target="save">Simpan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </x-buttons.button>
        </x-slot:footer>
    </x-ts-modal>
</form>