<?php

namespace App\Filament\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Pages\Auth\Register as AuthRegister;
use App\Models\User;
use Filament\Forms\Components\FileUpload;




class Register extends AuthRegister
{
    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('profile_image')
            ->avatar(),
            // Use Filament's existing form components
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

            // Add custom fields
            TextInput::make('contact_number')
                ->label('Contact Number')
                ->required()
                ->maxLength(15),

            Select::make('is_frequent_shopper')
                ->label('Is Frequent Shopper?')
                ->options([
                    1 => 'Yes',
                    0 => 'No',
                ])
                ->default('No')
                ->required()
        ])
        ->statePath('data');
    }
}
