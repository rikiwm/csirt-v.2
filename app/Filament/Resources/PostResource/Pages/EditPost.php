<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Forms\Components\Component;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPost extends EditRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviewAction::make(),

        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // builder editor
    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return match ($builderName) {
            'content' => 'filament.content.block-previews.heading',
        };
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {

        return match ($builderName) {
            'content' => PostResource::contentBuilderField(context: 'preview'),
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
