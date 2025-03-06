<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    //

    public function faq()
    {
        $menu = Menu::where('slug', 'faq')->first();
        $data = Page::query()->where('menu_id', $menu->id)->first();

        $category = Categori::query()->where('id', $data['data']['categori_id'] ?? null )->select('name','description')->first();
        if (!$category) {
            $category = Categori::query()->select('name','description')->get();
        }

        return view('page.faq',[
        'category' => $category ?? null,
        'title' => $menu['slug'],
        'data' => $data
    ]);
    }

    public function print(Request $request)
    {
        $tickets = Ticket::with('users','types')->select('id', 'subject', 'description','code','created_at','users_id','priority')->get();
        return view('filament.pages.ticket.ticket-print', compact('tickets'));

    }
}
