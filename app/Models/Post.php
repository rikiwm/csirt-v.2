<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'content' => 'array',
    ];
    public function categori()
    {
        return $this->belongsTo(Categori::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }


}
