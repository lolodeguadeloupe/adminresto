<?php

namespace App\Filament\Admin\Resources\RestaurantResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Restaurant;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->maxLength(255)->readonly(),
                    // Forms\Components\Select::make('status')->options([
                    //     'pending' => 'pending',
                    //     'preparing' => 'preparing',
                    //     'ready' => 'ready',
                    //     'completed' => 'completed',
                    //     'cancelled'=> 'cancelled',
                    // ])->default('pending'),
                    TextInput::make('status')->readonly(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('total_amount')
            ->columns([
                Tables\Columns\TextColumn::make('total_amount')->searchable()->toggleable()->sortable(),
                Tables\Columns\SelectColumn::make('status')->options([
                    'pending' => 'pending',
                    'preparing' => 'preparing',
                    'ready' => 'ready',
                    'completed' => 'completed',
                    'cancelled'=> 'cancelled',
                ])
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pickup_time')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->searchable()->toggleable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
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
