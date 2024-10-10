<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Pages\ViewRestaurant;
use App\Models\Restaurant;
use Filament\Tables\Table;
use App\Models\RestaurantType;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\RestaurantResource\Pages;
use App\Filament\Admin\Resources\RestaurantResource\RelationManagers;
use App\Filament\Admin\Resources\RestaurantResource\RelationManagers\OrdersRelationManager;
use App\Filament\Admin\Resources\RestaurantResource\RelationManagers\MenuItemsRelationManager;

class RestaurantResource extends Resource
{
    protected static ?string $model = Restaurant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Restaurants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('user_id')
                        ->label('Propriétaire')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable(),
                Select::make('restaurant_type_id')
                        ->label('Type')
                        ->options(RestaurantType::all()->pluck('name', 'id'))
                        ->searchable(),
                TextInput::make('description'),
                TextInput::make('address'),
                TextInput::make('phone'),
                TextInput::make('email')->email(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->toggleable(isToggledHiddenByDefault:true)
                ->sortable()
                ->searchable(),
                TextColumn::make('name')->searchable()->label('Nom'),
                TextColumn::make('user.name')->searchable()->label('Propriétaire')->toggleable(),
                TextColumn::make('user.email')->searchable()->label('Email Prprio')->toggleable(),
                TextColumn::make('restaurantType.name')->searchable()->label('Type de restaurant')->toggleable(),
                TextColumn::make('description')->searchable()->label('Description')->toggleable(),
                TextColumn::make('address')->searchable()->label('Adresse')->toggleable(),
                TextColumn::make('phone')->searchable()->label('Téléphone')->toggleable(),
                TextColumn::make('email')->searchable()->label('Email')->toggleable(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MenuItemsRelationManager::class,
            OrdersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRestaurants::route('/'),
            'create' => Pages\CreateRestaurant::route('/create'),
            'edit' => Pages\EditRestaurant::route('/{record}/edit'),
        ];
    }
    

}
