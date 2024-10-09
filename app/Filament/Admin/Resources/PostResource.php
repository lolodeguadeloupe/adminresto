<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\Post;
use App\Models\User;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\PostResource\Pages;
use App\Filament\Admin\Resources\PostResource\Pages\EditPost;
use App\Filament\Admin\Resources\PostResource\Pages\ListPosts;
use App\Filament\Admin\Resources\PostResource\Pages\CreatePost;
use App\Filament\Admin\Resources\PostResource\RelationManagers;
use App\Filament\Admin\Resources\PostResource\RelationManagers\AuthorsRelationManager;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Posts';
    

    public static function form(Form $form): Form
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
                    Select::make('category_id')
                                ->label('Catégorie')
                                ->options(Category::all()->pluck('name', 'id'))
                                // ->relationship('category','name')
                                ->searchable(),
                    Checkbox::make('published')->inline(false)->columnSpanFull(),
                ])->columnSpan(1),
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
                ImageColumn::make('thumbnail')->toggleable(),
                TextColumn::make('title')
                        ->toggleable()
                        ->sortable()
                        ->searchable(),
                TextColumn::make('slug')->sortable()
                ->toggleable()
                ->searchable(),
                TextColumn::make('content')->sortable()
                ->toggleable()
                ->searchable(),
                ColorColumn::make('color')->toggleable(),
                TextColumn::make('tags')->sortable()->toggleable()
                ->searchable(),
                CheckboxColumn::make('published')->toggleable(),
                TextColumn::make('category.name')->searchable()->toggleable(),
                TextColumn::make('created_at')->label('Date de publication')->date()->toggleable()
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
            AuthorsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
