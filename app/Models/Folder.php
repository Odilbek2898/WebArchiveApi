<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function cell()
    {
        return $this->belongsTo(Cell::class, 'cell_id');
    }

    public function box()
    {
        return $this->belongsTo(ArchiveBox::class, 'box_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'folder_id');
    }

    public function scopeSearch(Builder $query, Request $request)
    {
        if($request->folder_name){
            $query->where('name', 'LIKE', '%' .  $request->folder_name . '%');
        }
        return $query;
    }
}
