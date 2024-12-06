<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Models\Review;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReview extends CreateRecord
{
    protected static string $resource = ReviewResource::class;
    protected function getFormSchema(): array
    {
        return [
            Select::make('reviewable_type')
                ->label('Reviewable Type')
                ->options([
                    'App\\Models\\Post' => 'Post',
                    'App\\Models\\Product' => 'Product',
                ])
                ->required(),
            Select::make('reviewable_id')
                ->label('Reviewable Item')
                ->required()
                ->searchable()
                ->getSearchResultsUsing(function (string $query) {
                    $type = $this->data['reviewable_type'] ?? null;
                    return $type ? $type::query()
                        ->where('name', 'like', "%{$query}%")
                        ->pluck('name', 'id') : [];
                })
                ->required(),
            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->required(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (Review::where('user_id', $data['user_id'])
            ->where('reviewable_type', $data['reviewable_type'])
            ->where('reviewable_id', $data['reviewable_id'])
            ->exists()) {
            throw new \Exception('This review already exists.');
        }

        return $data;
    }
}
