<?php

namespace App\View;

use App\Models\Menu;
use App\Models\SettingWeb;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class GuestLayout extends Component
{

    public function render(): View
    {
        $nav = Cache::remember('nav_menus', 200, function () {
            return Menu::where('parent_id', null)
                ->with('children')->where('is_active', true)
                ->orderBy('order','asc')
                ->get();
        });

        $setting = Cache::remember('setting_copyright', 200, function () {
            return SettingWeb::query()->where('key','copyright')->first();
        });

        $kontak = Cache::remember('setting_address', 200, function () {
            return SettingWeb::query()->where('key','address')->first();
        });

        return view('layouts.app',[
            'copyright'=> $setting,
            'alamat'=> $kontak,
            'navbar' => $nav
        ]);
    }
}
