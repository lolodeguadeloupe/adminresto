<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\RelationManagers;
use App\Filament\Admin\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Filament\Admin\Resources\OrderResource\RelationManagers\RestaurantRelationManager;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Commandes';
    protected static ?string $navigationGroup = 'Restaurants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')->options([
                    'pending'=>'pending', 'preparing' =>'preparing', 'ready' =>'ready', 'completed' => 'completed', 'cancelled' => 'cancelled'
                ])->default('pending'),
                Select::make('restaurant_id')
                    ->relationship('restaurant', 'name')
                    ->required()->disabled(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('pickup_time')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status'),
                TextColumn::make('restaurant.name'),
                TextColumn::make('restaurant.id')->sortable(),
                TextColumn::make('user.name'),
                TextColumn::make('total_amount'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RestaurantRelationManager::class,
            OrderItemsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
