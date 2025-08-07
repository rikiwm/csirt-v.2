<?php

namespace App\View;

use App\Models\Menu;
use App\Models\SettingWeb;
use App\Models\WebVisitor;
use App\View\Components\footer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class AppLayout extends Component
{

    public function render(): View
    {
        $nav = Cache::remember('nav_menu', 3260, function () {
            return Menu::where('parent_id', null)
                ->with('children')->where('is_active', true)
                ->orderBy('order','asc')
                ->get();
        });

        $setting = Cache::remember('setting_copyright', 3260, function () {
            return SettingWeb::query()->where('key','copyright')->first();
        });

        $kontak = Cache::remember('setting_address', 3260, function () {
            return SettingWeb::query()->where('key','address')->first();
        });
        $hero = Cache::remember('setting_hero', 60, function () {
            return SettingWeb::query()->where('key','hero-section')->first();
        });

        $footer = new footer();
        $todayVisitors = WebVisitor::whereDate('visited_at', today())->count();
        $monthlyVisitors = WebVisitor::whereMonth('visited_at', now()->month)
                                    ->whereYear('visited_at', now()->year)
                                    ->count();

        $yearlyVisitors = WebVisitor::whereYear('visited_at', now()->year)->count();
        $onlineVisitors = WebVisitor::where('is_online', true)->count();
        return view('layouts.app',[
            'copyright'=> $setting,
            'alamat'=> $kontak,
            'hero'=> $hero,
            'footer'=> $footer,
            'navbar' => $nav,
            'visitor' => compact('todayVisitors', 'monthlyVisitors', 'yearlyVisitors', 'onlineVisitors')
        ]);
    }
}
