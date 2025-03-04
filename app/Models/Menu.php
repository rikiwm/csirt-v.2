<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    //
    use SoftDeletes, HasFactory;
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id')->where('parent_id', null);
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'menu_id');
    }


}
