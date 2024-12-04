<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;






class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationGroup = 'User Management';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                            ->required()
                            ->default(null)
                            //->unique('users', 'name')

                            ->maxLength(255),
               
                Forms\Components\TextInput::make('contact_number')
                            ->numeric()
                            ->maxlength(11),
                Forms\Components\Select::make('is_frequent_shopper')
                            ->options([
                                0 => 'No',
                                1 => 'Yes',
                            ]),
                Forms\Components\TextInput::make('email')
                            ->email(),
                Forms\Components\TextInput::make('password')->confirmed()
                            ->password()
                            ->required()
                            ->revealable()
                            //->default(fn($record) => $record->password)  
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->visible(fn ($livewire) =>$livewire instanceof Pages\CreateUser),
                            //->rule(Password::default ())
                            //->hiddenOn('edit'),
                Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            //->same('password')                          
                            ->requiredWith('password')
                            ->revealable()
                            ->visible(fn ($livewire) =>$livewire instanceof Pages\CreateUser),
                            FileUpload::make('profile_image')
                            ->avatar()
                            
                   
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_image')
                ->circular(),
                Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false)
                ->sortable(),
                Tables\Columns\TextColumn::make('contact_number')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false)
                ->sortable(),
                Tables\Columns\IconColumn::make('is_frequent_shopper')
                ->icon(fn (string $state): string => match ($state) {
                    '1' => 'heroicon-o-check',
                    '0' => 'heroicon-o-x-circle',
                })
                ->color(fn (string $state): string => match ($state) {
                  
                    '0' => 'danger',
                    '1' => 'success',
                })
                ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('email')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: false)
                ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
