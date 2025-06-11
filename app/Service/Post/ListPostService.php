<?php

namespace App\Service\Post;

use App\Models\Post;
use App\Service\Post\PostInterfaces\PostInterface;

class ListPostService implements PostInterface
{
    public function show($type, $slug, $id)
    {
        $top = Post::query()->with('author')->where('is_active', 1)->where('is_featured', 1)->orderBy('created_at','desc')->first();
        $data = Post::query()->with('author')
                ->whereHas('menu', fn ($q) => $q->where('type', 'list'))
                ->where('is_active', 1)->orderBy('created_at','desc')
                ->where('menu_id', $id)->get();
        return [
            'title' => $slug,
            'top' => $top,
            'data' => $data,
            'view' => 'page.list',
        ];
    }
}
