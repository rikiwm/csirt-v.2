<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //
    public function list($slug)
    {
        try {
            $data = cache()->remember("post_{$slug}", 60, function() use ($slug) {
                return Post::where('slug', $slug)->first();
            });

            if (!$data) {
                abort(404, 'Post not found');
            }

            return view('page.list-show', compact('slug', 'data'));
        } catch (\Exception $e) {
            return redirect()->back();
            // return response()->view('errors.custom', [], 500);
        }
    }
}
