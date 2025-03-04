<?php

namespace App\Service\Post;

use App\Models\Post;
use App\Service\Post\PostInterfaces\PostInterface;

class ListPostService implements PostInterface
{
    public function show($type, $slug, $id)
    {
        $data = Post::query()
                ->whereHas('menu', fn ($q) => $q->where('type', 'list'))
                ->where('is_active', 1)->orderBy('created_at','desc')
                ->where('menu_id', $id)->get();

        return [
            'title' => $slug,
            'data' => $data,
            'view' => 'page.list',
        ];
    }
}
