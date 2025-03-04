<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Forms\Components\Actions as ComponentsActions;
use Filament\Forms\Components\Component;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPage extends EditRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviewAction::make(),

        ];
    }

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return match ($builderName) {
            'content' => 'filament.content.block-previews.heading',
        };
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {

        return match ($builderName) {
            'content' => PageResource::contentBuilderField(context: 'preview'),
        };
        // return PageResource::contentBuilderField(context: 'priview');
    }



    public function getPreviewModalView(): ?string
    {
        return 'filament.content.block-previews.priview-blocks';
    }

    public function getPreviewModalDataRecordKey(): ?string
    {
        return 'content';
    }

}
