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

        try {
            $data = Page::query()->where('slug', $slug)->where('menu_id', $id)->where('is_active', 1)->first();
            return [
                'title' =>$data->title,
                'data' => $data,
                'view' => 'page.page',
            ];

        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Page not found');
        }

    }
}
