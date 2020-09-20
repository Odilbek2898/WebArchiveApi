<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $files = File::query()->with('folder')->search($request);

        return $files->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'folder_id' => 'required|integer'
        ]);

        Folder::query()
            ->where('id', $request->folder_id)
            ->firstOrFail();

        $uploadedFile = $request->file('file');
        $uuid = Str::uuid();
        $file_name = $uuid . '.' . $uploadedFile->getClientOriginalExtension();
        $folder_name = '/upload';
        Storage::disk('local')->putFileAs(
            $folder_name,
            $uploadedFile,
            $file_name
        );

        $file = new File;
        $file->name = $uploadedFile->getClientOriginalName();
        $file->path = $folder_name . '/' . $file_name;
        $file->folder_id = $request->folder_id;
        $file->save();

        return $file;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $file = File::query()->findOrFail($id);

        return $file;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFile($id)
    {
        $file = File::query()->findOrFail($id);
        $file1 = Storage::disk('local')->response($file->path);

        return $file1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $file = File::query()->findOrFail($id);
        $file->delete();

                return response()->json(['message' => 'Объект успешно удален']);
    }
}
