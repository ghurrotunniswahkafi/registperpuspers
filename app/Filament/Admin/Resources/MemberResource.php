<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $title = 'Member';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                
                TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable(),
                
                TextColumn::make('asal_alamat')
                    ->label('Asal Alamat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->visible($user->isPetinggi()),
                
                Tables\Actions\EditAction::make()
                    ->visible($user->isAdmin()),
                
                Tables\Actions\DeleteAction::make()
                    ->visible($user->isAdmin()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible($user->isAdmin()),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'view' => Pages\ViewMember::route('/{record}'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }

    // Permission methods
    public static function canCreate(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function canEdit(mixed $record): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function canDelete(mixed $record): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->canAccessFilament();
    }

    public static function canView(mixed $record): bool
    {
        return auth()->user()->canAccessFilament();
    }
}
