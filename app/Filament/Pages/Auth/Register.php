<?php

namespace App\Filament\Pages\Auth;

use Faker\Provider\ar_EG\Text;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Nette\Utils\Html;

class Register extends BaseRegister
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // protected static string $view = 'filament.pages.auth-register';

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        TextInput::make('profiles.job')->label('Job'),
                        Textarea::make('profiles.address')->label('Address'),
                        Placeholder::make('role')->label(false)->content(
                            new HtmlString('<a href="/"  class="underline">Back Home</a>')
                         ),
                    ])
                    ->statePath('data'),
            ),
        ];
    }


    protected function handleRegistration(array $data): Model
    {
        $userData = Arr::except($data, ['profiles']);
        $profileData = $data['profiles'] ?? [];

        $user = $this->getUserModel()::create($userData);
        $user->assignRole('user');

        $user->profiles()->create($profileData);
        return $user;

    }
}
