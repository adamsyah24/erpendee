<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Media;
// use App\Models\Media;

class Medias extends Page
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    // protected static ?int $navigationSort = -2;

    protected static ?string $navigationGroup = 'Client and Vendor Management';

    protected static string $view = 'filament.pages.media';

    protected function getHeaderWidgets(): array
    {
        return [
            MediaWidgets\Medias::class,
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }
}
