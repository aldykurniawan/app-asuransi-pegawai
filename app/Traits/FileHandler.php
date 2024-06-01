<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileHandler
{
    /**
     * Handle Upload File.
     *
     * @param mixed $requestFile
     * @param mixed $namaFile
     * @param mixed $path
     * @return array<string, string>
     */
    public static function uploadFile($requestFile, $namaFile, $path)
    {
        $ext      = $requestFile->extension();
        $namaFile = time().'_'.$namaFile;
        $namaFile = str_replace('%', '', $namaFile);
        $namaFile = Str::slug($namaFile, '-').'.'.$ext;
        $fullPath = $requestFile->storeAs($path, $namaFile, 'public');

        $data = [
            'file_name' => $namaFile,
            'file_path' => '/storage/'.$fullPath,
        ];

        return $data;
    }

    /**
     * Delete Data.
     *
     * @param $path
     * @return null
     */
    public static function deleteFile($path)
    {
        if (Storage::disk('public')->exists(Str::replace('/storage', '', $path))) {
            Storage::disk('public')->delete(Str::replace('/storage', '', $path));
        }
    }

    public static function move($oldFolder, $oldFilePath, $newFileName, $newFilePath)
    {
        $fullPath    = $newFilePath.'/'.$newFileName;
        $oldFilePath = Str::replace('/storage', '', $oldFilePath);
        $oldFolder   = Str::replace('/storage', '', $oldFolder);

        Storage::disk('public')->move($oldFilePath, $fullPath);

        $data = [
            'file_name' => $newFileName,
            'file_path' => '/storage/'.$fullPath,
        ];

        self::deleteFile($oldFilePath);
        Storage::disk('public')->deleteDirectory($oldFilePath);

        return $data;
    }
}
