<?php

namespace App\Traits;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Buglinjo\LaravelWebp\Facades\Webp;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    protected static function saveOrUpdateFile($file, $location)
    {
        try {
            if ($file instanceof UploadedFile) {
                $main_folder = Carbon::now()->isoFormat('Y') . '/' . Carbon::now()->isoFormat('MM');
                $newImageResult = static::handleUploadFile($file, "public/$main_folder/" . $location);
                
                // Check if result is array (for images) or string (for videos/other files)
                if (is_array($newImageResult)) {
                    // For images (WebP conversion) - returns [$path, $filename]
                    $path = "$main_folder/" . $location . '/' . $newImageResult[1];
                } else {
                    // For videos and other files - returns full path from storeAs()
                    $path = str_replace('public/', '', $newImageResult);
                }
            } else {
                $path = str_replace('/storage/', '', $file);
            }
            return $path;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Upload file using storeAs() function. Recommend for saving file in storage's symlink folder.
     *
     * @param  Illuminate\Support\Facades\Request::File $file - the uploaded file (e.g., $request->thumbnail)
     * @param  string $where - path you want to put the file at (e.g., "public/photos")
     * @param  string $identifier - custom identifier, adding custom string in front of the filename, required if this function is called twice in the same code to prevent generating duplicate filenames. (example, adding "thumbnail" will make generated file name like "thumbnail_filename_time().jpg")
     * @return array [$path, $savedFileName]
     */
    protected static function handleUploadFile($file, $where, $identifier = null, $except_png = true, $isCompressed = true)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = null;

        for ($i = 1; $i <= rand(50, 100); $i++) {

            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $filename .= $character;

        }

        if ($identifier) {

            $savedFileName = $identifier . '_' . $filename . '.' . $extension;

        } else {

            $savedFileName = $filename . '.' . $extension;
        }

        static::createDirectory($where);

        // Handle image compression for supported formats
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) && $isCompressed) {
            // For images, use WebP conversion
            $webpFileName = $identifier ? $identifier . '_' . $filename . '.webp' : $filename . '.webp';
            $new_file = Webp::make($file);
            $path = $new_file->save(storage_path("app/{$where}/{$webpFileName}"));
            return [$path, $webpFileName];
        } else {
            // For videos, WebP files, and other formats, use public disk to ensure symlink exposure
            $relativePath = str_replace('public/', '', $where);
            $storedPath = $file->storeAs($relativePath, $savedFileName, 'public');
            return ["public/{$storedPath}", $savedFileName];
        }
    }

    /**
     * Upload file from URL using storeAs() function. Recommend for saving file in storage's symlink folder.
     *
     * @param  Illuminate\Support\Facades\Request::File $file - the uploaded file (e.g., $request->thumbnail)
     * @param  string $where - path you want to put the file at (e.g., "partner/bg_photo")
     * @param  string $identifier - custom identifier, adding custom string in front of the filename, required if this function is called twice in the same code to prevent generating duplicate filenames. (example, adding "thumbnail" will make generated file name like "thumbnail_filename_time().jpg")
     * @return array [$is_saved, $savedFileName]
     */
    protected static function uploadImageFromUrl($url, $where, $identifier = null)
    {
        $filename = null;

        for ($i = 1; $i <= rand(50, 100); $i++) {

            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $filename .= $character;

        }

        if ($identifier) {

            $savedFileName = $identifier . '_' . $filename . '.webp';

        } else {

            $savedFileName = $filename . '.webp';
        }

        $image_file = file_get_contents($url);
        $relativePath = str_replace('public/', '', $where);
        $is_saved = Storage::disk('public')->put("$relativePath/$savedFileName", $image_file);

        return [$is_saved, $savedFileName];
    }

    /**
     * Creating Directory if not exist using File::isDirectory() & File::makeDirectory() function. this function will creating the folder only if the folder does not exist.
     *
     * @param  string $path - path of the folder, it will use public_path() (e.g., "public/photos")
     * @param  string $identifier - custom identifier, adding custom string in front of the filename, required if this function is called twice in the same code to prevent generating duplicate filenames. (example, adding "thumbnail" will make generated file name like "thumbnail_filename_time().jpg")
     * @return array [$path, $savedFileName]
     */
    protected static function createDirectory($path): void
    {
        $path = storage_path("app/$path");

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }
}
