<?php

namespace App\Service\Menu;

use App\Service\Post\PostInterfaces\PostInterface;

class MenuService implements PostInterface
{
    /**
     * Create a new class instance.
     */
    public function show($type, $slug, $id)
    {
        redirect()->route('home');

    }
}
