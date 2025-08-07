<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListController extends Controller
{
    //
    public function list($slug)
    {
        try {
            $data = Cache::remember("post_{$slug}", 1260, function() use ($slug) {
                return Post::with('author','categori','menu')->where('slug', $slug)->first();
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
