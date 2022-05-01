<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    //redirect to index
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}