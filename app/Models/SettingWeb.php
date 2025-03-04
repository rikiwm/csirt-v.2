<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingWeb extends Model
{
    //
    protected $guarded = ['id'];

    protected $casts = [
        'value' => 'array',
    ];
}
