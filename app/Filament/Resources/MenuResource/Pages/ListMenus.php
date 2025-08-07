<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



    public function getTabs(): array
    {
        {
            $tabs = [
                'Menu' => Tab::make()->icon('heroicon-o-bars-3')->query(fn ($query) => $query->where('type', 'place')),
                'Page' => Tab::make()->icon('heroicon-o-document')->query(fn ($query) => $query->where('type', 'page')),
                'Post' => Tab::make()->icon('heroicon-o-document-duplicate')->query(fn ($query) => $query->where('type', 'list')),
                'Link' => Tab::make()->icon('heroicon-m-globe-alt')->query(fn ($query) => $query->where('type', 'link')),
            ];

            return $tabs;
        }
    }
}
