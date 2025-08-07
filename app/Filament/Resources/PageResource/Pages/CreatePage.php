<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Menu;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class CreatePage extends CreateRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = PageResource::class;
    public  bool $visible;
    public  string $save;
    public  string $icon;

    protected function getFormActions($visible = false, $save = 'Save',$icon= 'heroicon-o-shield-check'): array
    {
        $this->visible = $visible;
        $this->save = $save;
        $this->icon = $icon;
            $q = Menu::query()->where('type', 'page') ->whereNotIn('id', Page::query()->pluck('menu_id')->toArray());
            if ($q->count() == 0) {
                 $visible = true;
                 $save = 'Pilih Menu terlebih dahulu';
                 $icon = 'heroicon-m-shield-exclamation';
            }
        return [
            $this->getCreateFormAction()->label($save)->disabled($visible)->icon($icon),
            $this->getCancelFormAction()->label('Cancel')
        ];

    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        // This corresponds to resources/views/posts/preview-blocks.blade.php
        return 'filament.content.block-previews.heading';
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {
        return PageResource::contentBuilderField(context: 'preview');
    }

}


