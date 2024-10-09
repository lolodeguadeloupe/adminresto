<?php

namespace App\Filament\Admin\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Create a post')
            ->description('On créé les posts ici')
            ->schema([
                TextInput::make('title')->required(),
                MarkdownEditor::make('content')->required()->columnSpan('full'),
                TextInput::make('slug')->required(),
                ColorPicker::make('color')->required(),
                TagsInput::make('tags')->required(),
            ])->columnSpan(2),
            
            Section::make('Méta')
            ->description('Ici les données non obligatoires')
            ->collapsible()
            ->schema([
                FileUpload::make('thumbnail')->disk('public')->directory('thumbnails')->columnSpan(3),
                // Select::make('category_id')
                //             ->label('Catégorie')
                //             ->options(Category::all()->pluck('name', 'id'))
                //             // ->relationship('category','name')
                //             ->searchable(),
                Checkbox::make('published')->inline(false)->columnSpanFull(),
            ])->columnSpan(1),
           
         ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                        ->toggleable()
                        ->sortable()
                        ->searchable(),
                TextColumn::make('content')->sortable()
                ->toggleable()
                ->searchable(),
                TextColumn::make('tags')->sortable()->toggleable()
                ->searchable(),
                CheckboxColumn::make('published')->toggleable(),
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
