<?php

namespace App\Filament\Admin\Resources\RestaurantResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RestaurantType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'menuItems';
    protected static ?string $modelLabel = 'Menus';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('description'), 
                TextInput::make('price')->numeric(),
                Checkbox::make('available')->label('Disponible'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('menuCategory.name')->label('Catégorie')->toggleable()->searchable(),
                Tables\Columns\TextColumn::make('price')->label('Prix')->toggleable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->toggleable(),
                Tables\Columns\CheckboxColumn::make('available')->label('Disponible')->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
