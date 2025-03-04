<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListPost extends Component
{

    public  $data = [];
    public ?string $title;
    public ?int $limit;
    /**
     * Create a new component instance.
     */

    public function __construct($data = null,$title = null, $limit = null)
    {
        $this->data = $data;
        $this->limit = $limit ?? 3;
        $this->title = collect($title) ?? null;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.list-post',[
            'data' => $this->data,
            'title' => $this->title,
            'limit' => $this->limit
        ]);
    }
}
