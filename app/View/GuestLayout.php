<?php

namespace App\View;

use App\Models\Menu;
use App\Models\SettingWeb;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GuestLayout extends Component
{

    public function render(): View
    {
        $nav = cache()->remember('nav_menu', 60*60, function () {
            return Menu::where('parent_id', null)
                ->with('children')->where('is_active', true)
                ->orderBy('id')
                ->get();
        });

        $setting = cache()->remember('setting_copyright', 60*60, function () {
            return SettingWeb::query()->where('key','copyright')->first();
        });

        $kontak = cache()->remember('setting_address', 60*60, function () {
            return SettingWeb::query()->where('key','address')->first();
        });

        return view('layouts.app',[
            'copyright'=> $setting,
            'alamat'=> $kontak,
            'navbar' => $nav
        ]);
    }
}
