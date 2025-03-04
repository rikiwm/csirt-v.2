<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categori extends Model
{
    //
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Categori::class, 'parent_id')->where('parent_id', null);
    }
}
