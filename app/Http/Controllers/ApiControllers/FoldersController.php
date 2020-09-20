<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Folder;
use Illuminate\Http\Request;

class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $folders = Folder::query()->with(['box', 'cell'])->search($request);

        return $folders->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'box_id'=>'required|integer',
            'cell_id'=>'required|integer'
        ]);

        Cell::query()
            ->where('box_id', $request->box_id)
            ->where('id', $request->cell_id)
            ->firstOrFail();


        $folder = new Folder(['name' => now() ."_" . $request->name]);
        $folder->box_id = $request->box_id;
        $folder->cell_id = $request->cell_id;

        $folder->save();

        return $folder;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = Folder::query()->findOrFail($id);

        return $folder;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'box_id'=>'nullable|integer',
            'cell_id'=>'nullable|integer'
        ]);

        Cell::query()
            ->where('box_id', $request->box_id)
            ->where('id', $request->cell_id)
            ->firstOrFail();

        $folder = Folder::query()->findOrFail($id);

        $folder->box_id=$request->box_id;
        $folder->cell_id=$request->cell_id;
        $folder->save();

        return $folder;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder = Folder::query()->findOrFail($id);
        $folder->files()->delete();
        $folder->delete();

        return response()->json(['message' => 'Объект успешно удален']);
    }
}
