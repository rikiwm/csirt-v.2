<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //
    public function list($slug)
    {
        $data = cache()->remember("post_{$slug}", 60, function() use ($slug) {
            return Post::where('slug', $slug)->firstOrFail();
        });

        return view('page.list-show', compact('slug', 'data'));
    }
}
