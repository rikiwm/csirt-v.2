<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class ResponTimeAgenWidget extends BaseWidget
{



    // protected function getStats(): array
    // {
    //     $averageResponseTime = Ticket::where('status', 'closed')
    //     ->join('ticket_massages as first_message', function ($join) {
    //         $join->on('tickets.id', '=', 'first_message.ticket_id')
    //             ->whereRaw('first_message.id = (SELECT MIN(id) FROM ticket_massages WHERE ticket_massages.ticket_id = tickets.id)');
    //     })
    //     ->join('ticket_massages as first_reply', function ($join) {
    //         $join->on('tickets.id', '=', 'first_reply.ticket_id')
    //             ->whereRaw('first_reply.id = (
    //                 SELECT MIN(id) FROM ticket_massages
    //                 WHERE ticket_massages.ticket_id = tickets.id
    //                 AND ticket_massages.user_id != first_message.user_id
    //             )');
    //     })
    //     ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, first_message.created_at, first_reply.created_at)) as avg_response_time'))
    //     ->value('avg_response_time');

    //     return [
    //         Stat::make('Progress',  gmdate("i:s", $averageResponseTime) . ' Menit')
    //         ->label(false)
    //         ->color('warning')
    //         ->description('Response Time Average')
    //         ->descriptionIcon('heroicon-m-clock'),



    //     ];

    // }
}

// $averageResponseTime = Ticket::where('status', 'closed')
// ->join('ticket_massages as first_message', function ($join) {
//     $join->on('tickets.id', '=', 'first_message.ticket_id')
//         ->whereRaw('first_message.id = (SELECT MIN(id) FROM ticket_massages WHERE ticket_massages.ticket_id = tickets.id)');
// })
// ->join('ticket_massages as first_reply', function ($join) {
//     $join->on('tickets.id', '=', 'first_reply.ticket_id')
//         ->whereRaw('first_reply.id = (
//             SELECT MIN(id) FROM ticket_massages
//             WHERE ticket_massages.ticket_id = tickets.id
//             AND ticket_massages.user_id != first_message.user_id
//         )');
// })
// ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, first_message.created_at, first_reply.created_at)) as avg_response_time'))
// ->value('avg_response_time');

// return [
//     Stat::make('Progress',  gmdate("i:s", $averageResponseTime) . ' Menit')
//     ->label(false)
//     ->color('primary')
//     ->description('In Progress ')
//     ->chart([1, 2, 3, 4, 5, 6, 7])
//     ->descriptionIcon('heroicon-m-clock'),

// ];
