<?php

namespace App\Service\Post;

use App\Models\Page;
use App\Service\Post\PostInterfaces\PostInterface;

class PagePostService implements PostInterface
{
    public $view;
    public $title;

    public function show($type,$slug,$id)
    {

        $data = Page::query()->where('slug', $slug)->where('menu_id', $id)->where('is_active', 1)->first();

        if (!$data) {
            return redirect()->back();
        }
        return [
            'title' =>$data->title,
            'data' => $data,
            'view' => 'page.page',
        ];
    }
}
