<?php

namespace App\Service\Post\PostInterfaces;

interface PostInterface
{
    public function show($type, $slug, $id);
}
