<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Models\Profile as ModelsProfile;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\EditProfile as BaseProfile;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Profile extends BaseProfile
{

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Tabs::make('Profile')
                        ->contained(false)
                        ->tabs([
                            Tabs\Tab::make('Profile')->icon('heroicon-m-user')
                            ->iconPosition(IconPosition::Before)->schema([
                                Placeholder::make('profile')->label(false)->content(
                                    new HtmlString('<a href="/"  class="underline">Back Home</a>')
                                 ),
                                 Section::make('User')->schema([
                                    // tabel users
                                    $this->getNameFormComponent(),
                                    $this->getEmailFormComponent(),
                                    $this->getPasswordFormComponent(),
                                    $this->getPasswordConfirmationFormComponent(),
                                    ])->columns(2),
                            ]),
                            Tabs\Tab::make('Detail')->icon('heroicon-m-information-circle')
                            ->iconPosition(IconPosition::After)->schema([
                                Placeholder::make('profile')->label(false)->content(
                                    new HtmlString('<a href="/"  class="underline">Back </a>')
                                 ),
                                 Fieldset::make('Profile')->schema([
                                    TextInput::make('users_id')
                                    ->default(auth()->id())
                                    ->hidden(),
                                    TextInput::make('address')->label('address'),
                                    TextInput::make('nik')->label('nik'),
                                    TextInput::make('phone_number')->label('Hp'),
                                    TextInput::make('jobs')->label('jobs'),
                                ])->columns(3),
                            ]),
                        ]),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $profile = ModelsProfile::where('users_id', auth()->id())->first();
        if ($profile) {
            $data = array_merge($data, $profile->toArray());
        }
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return tap(parent::handleRecordUpdate($record, $data), function () use ($data) {
            $this->updateProfile($data);
        });
    }

    protected function updateProfile(array $data): void
    {
        ModelsProfile::updateOrCreate(
            ['users_id' => auth()->id()],
            [
                'address' => $data['address'],
                'nik' => $data['nik'],
                'phone_number' => $data['phone_number'],
                'jobs' => $data['jobs'],
                ]
        );
        // ModelsProfile::where('users_id', auth()->id())->update($data);
    }
}
// $table->foreignId('users_id')->nullable()->index();
// $table->string('address')->nullable();
// $table->string('address_second')->nullable();
// $table->integer('phone_number')->nullable()->unique()->index();
// $table->integer('nik')->nullable()->unique()->index();
// $table->string('jobs')->nullable();
// $table->string('img_profile')->nullable();
// $table->string('device')->nullable()->comment('hp si user');
