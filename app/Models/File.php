<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function scopeSearch(Builder $query, Request $request)
    {
        if($request->file_name){
            $query->where('name', 'LIKE', '%' .  $request->file_name . '%');
        }
        return $query;
    }
}
