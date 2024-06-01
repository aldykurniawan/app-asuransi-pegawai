<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\DataMaster\File as FileData;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdditionalController extends Controller
{
    use FileHandler;

    public function generateUrl(...$paths)
    {
        // Gabungkan semua elemen $paths kecuali yang terakhir
        $folderPath = implode('/', array_map(function ($path) {
            return trim($path, '/');
        }, array_slice($paths, 0, -1)));

        // Ambil nama file dari elemen terakhir $paths
        $filename = end($paths);

        $path = storage_path('app/public/'.$folderPath.'/'.$filename);

        if (! File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        // Gunakan helper response() untuk membuat Response
        $response = response($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }

    public function storeImage(Request $request)
    {
        $file = $request->file('file');
        // move to storage
        $fileName = $this->uploadFile($file, $request->model, $request->model);
        // insert to file
        $folderModel = ucwords($request->model);
        if ($request->$folderModel && $request->foldermodel !== '') {
            $folderModel = ucwords($request->foldermodel).'\\'.ucwords($request->model);
        }
        $model     = 'App\Models\\'.$folderModel;
        $findModel = $model::find($request->idData);
        $url       = url('file/'.$request->model.'/'.$fileName['file_name']);
        // create file using model
        $findModel->file()->create([
            'file_url'  => 'file/'.$request->model.'/'.$fileName['file_name'],
            'file_name' => $fileName['file_name'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File Uploaded',
            'url'     => $url,
        ]);
    }

    // multiple storeImage
    public function storeImageMultiple(Request $request)
    {
        // foreach request->file
        foreach ($request->file as $file) {
            // move to storage
            $fileName = $this->uploadFile($file, $request->model, $request->model);
            // insert to file
            // insert to file
            $folderModel = ucwords($request->model);
            if ($request->$folderModel && $request->foldermodel !== '') {
                $folderModel = ucwords($request->foldermodel).'\\'.ucwords($request->model);
            }
            $model     = 'App\Models\\'.$folderModel;
            $findModel = $model::find($request->idData);
            $url       = url('file/'.$request->model.'/'.$fileName['file_name']);
            // create file using model
            $findModel->file()->create([
                'file_url'  => 'file/'.$request->model.'/'.$fileName['file_name'],
                'file_name' => $fileName['file_name'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'File Uploaded',
        ]);
    }

    // remove File based on ID
    public function removeFile($id, $folder)
    {
        $file = FileData::find($id);
        // remove file from storage
        $this->deleteFile($folder.'/'.$file->file_name);
        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File Deleted',
        ]);
    }
}
