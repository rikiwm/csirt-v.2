<?php

namespace App\View\Components;

use App\Models\SettingWeb;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class footer extends Component
{
public $footer = [];

    public function __construct($footer = null)
    {
        $this->footer = $footer;
    }

    public function render(): View|Closure|string
    {
        $f = cache()->remember('setting_footer', 60*60, function () {
            return SettingWeb::query()->where('key','footer')->first();
        });
        $this->footer = $f;
        return view('components.footer',[
            'footer' => $this->footer,
        ]);
    }
}
