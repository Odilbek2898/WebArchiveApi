<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveBox extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function cells(){
        return $this->hasMany(Cell::class, 'box_id');
    }

    public function folders(){
        return $this->hasMany(Folder::class, 'box_id');
    }

}
