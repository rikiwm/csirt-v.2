<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Image\Cache;

class StaticController extends Controller
{
    //

    public function faq()
    {
        $menu = Cache::remember('faq_menu', 1260, function() {
            return Menu::where('slug', 'faq')->first();
        });
        $data = Cache::remember('faq_data', 60, function() {
            return Page::query()->where('menu_id', $menu->id)->first();
        });

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
        $pdf = Pdf::loadView('filament.pages.ticket.ticket-print',compact('tickets'));
        return $pdf->stream();

    }
}
