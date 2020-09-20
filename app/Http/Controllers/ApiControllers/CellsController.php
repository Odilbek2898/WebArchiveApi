<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use Illuminate\Http\Request;


class CellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cells = Cell::query()->paginate(5);

        return $cells;
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
     * @param \Illuminate\Http\Request $request
     * @param $box
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'box_id'=>'required|integer',
        ]);

        $cell = new Cell(['name' => now() ."_" . $request->name]);
        $cell->box_id = $request->box_id;
        $cell->save();

        return $cell;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cell = Cell::query()->findOrFail($id);

        return $cell;
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
        $cell = Cell::query()->findOrFail($id);
        $folders = $cell->folders;
        foreach ($folders as $folder) {
            $folder->files()->delete();
        }
        $cell->folders()->delete();
        $cell->delete();

        return response()->json(['message' => 'Объект успешно удален']);
    }
}
