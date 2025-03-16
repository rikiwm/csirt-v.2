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
        $nav = Cache::remember('nav_menus', 60, function () {
            return Menu::where('parent_id', null)
                ->with('children')->where('is_active', true)
                ->orderBy('id')
                ->get();
        });

        $setting = Cache::remember('setting_copyright', 60, function () {
            return SettingWeb::query()->where('key','copyright')->first();
        });

        $kontak = Cache::remember('setting_address', 60, function () {
            return SettingWeb::query()->where('key','address')->first();
        });

        return view('layouts.app',[
            'copyright'=> $setting,
            'alamat'=> $kontak,
            'navbar' => $nav
        ]);
    }
}
