<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Forms\Components\Component;
use Filament\Resources\Pages\CreateRecord;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class CreatePost extends CreateRecord
{
    use HasPreviewModal;
    use HasBuilderPreview;

    protected static string $resource = PostResource::class;


    protected  function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Save')->disabled(false),
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
        return PostResource::contentBuilderField(context: 'preview');
    }

}
