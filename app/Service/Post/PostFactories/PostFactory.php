<?php

namespace App\Service\Post\PostFactories;

use App\Service\Menu\MenuService;
use App\Service\Post\ListPostService;
use App\Service\Post\PagePostService;
use App\Service\Post\PostInterfaces\PostInterface;

class PostFactory
{
    public static function make($type): PostInterface
    {
        switch ($type) {
            case 'list':
                return new ListPostService();
            case 'page':
                return new PagePostService();
            case 'link':
                return new MenuService();
            case 'place':
                throw new \Exception("Unsupported ");
                return redirect()->route('home')->with('error', $e->getMessage());
                default:
                return abort(404);
        }
    }
}
