<?php

declare(strict_types=1);

namespace Workbench\App\Filament\Resources\Users;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Workbench\App\Filament\Resources\Users\Pages\ListUsers;
use Workbench\App\Models\User;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedUsers;

    public static function table(Table $table): Table
    {
        return $table
            ->extraAttributes(['data-focus' => 'users-table'])
            ->columns([
                ImageColumn::make('avatar')
                    ->state(fn (User $record): string => filament()->getUserAvatarUrl($record))
                    ->circular()
                    ->imageSize(40),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
            ])
            ->defaultSort('id')
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
        ];
    }
}
