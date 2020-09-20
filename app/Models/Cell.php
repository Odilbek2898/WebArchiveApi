<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function archive_box()
    {
        return $this->belongsTo(ArchiveBox::class, 'box_id');
    }

    public function folders(){
        return $this->hasMany(Folder::class, 'cell_id');
    }
}
