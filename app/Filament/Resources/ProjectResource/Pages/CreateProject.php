<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    // protected function handleRecordCreation(array $data): Model
    // {
    //     $image = $data['image'];
    //     unset($data['image']);
    //     $model = static::getModel()::create($data);
    //     return $model;
    // }
}
