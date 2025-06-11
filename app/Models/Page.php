<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    //
    use SoftDeletes, HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'content' => 'array',
    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function category()
    {
        return $this->belongsTo(Categori::class, 'categori_id');
    }

    public function menus()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }

       public function author()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    
}
