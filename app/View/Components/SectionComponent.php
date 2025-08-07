<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionComponent extends Component
{
    public $section = null;

    /**
     * Create a new component instance.
     */
    public function __construct($section = null)
    {
        //
        $this->section = $section;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = Post::query()->with('menu')->where('is_active', true)->first();
        return view('components.section-component',[
            'section' => $this->section,
            'data' => $data ?? null,
            'link' =>$data->menu->slug ?? null,
        ]);
    }
}
