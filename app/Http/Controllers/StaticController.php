<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    //

    public function faq()
    {
        return view('page.faq');
    }

    public function print(Request $request)
    {
        $tickets = Ticket::with('users','types')->select('id', 'subject', 'description','code','created_at','users_id','priority')->get();
        return view('filament.pages.ticket.ticket-print', compact('tickets'));

    }
}
