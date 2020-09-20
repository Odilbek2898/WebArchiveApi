<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\ArchiveBox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



class BoxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxes = ArchiveBox::query()->paginate(5);

        return $boxes;
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
        //validatsiya yozish kerak
        $request->validate([
            'box_name'=> 'required|string'
        ]);

        $box = new ArchiveBox(['name' => now() ."_" . $request->box_name]);
        $box->save();

        return $box;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $box = ArchiveBox::query()->findOrFail($id);

        return $box;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $box = ArchiveBox::query()->findOrFail($id);
        $folders = $box->folders;
        foreach ($folders as $folder) {
            $folder->files()->delete();
        }
        $cells = $box->cells;
        foreach ($cells as $cell) {
            $cell->folders()->delete();
        }
        $box->cells()->delete();
        $box->delete();

        return response()->json(['message' => 'Объект успешно удален']);
    }
}
