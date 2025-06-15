<?php

namespace App\Filament\Pages;

use App\Models\SettingWeb;
use App\Models\TicketSetting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
class MailSettings extends Page implements HasForms
{
    use HasPageShield, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-c-cog';
    protected static ?string $title = 'Config';
    protected static string $view = 'filament.pages.mail-settings';
    public ?array $data = [];
   protected static bool $shouldRegisterNavigation = false;

    public function mount(): void
    {
         $smtp = smtp_setting();
        $this->form->fill([
            'status' => \App\Models\SettingWeb::where('key', 'smtp')->value('status') ?? true,
            'mail_host' => smtp_setting('mail_host', env('MAIL_HOST')),
            'mail_host' => smtp_setting('mail_host', env('MAIL_HOST')),
            'mail_port' => smtp_setting('mail_port', env('MAIL_PORT')),
            'mail_encryption' => smtp_setting('mail_encryption', env('MAIL_ENCRYPTION')),
            'mail_username' => smtp_setting('mail_username', env('MAIL_USERNAME')),
            'mail_password' => smtp_setting('mail_password', env('MAIL_PASSWORD')),
            'mail_from_address' => smtp_setting('mail_from_address', env('MAIL_FROM_ADDRESS')),
            // 'mail_from_name' => smtp_setting('mail_from_name', env('MAIL_FROM_NAME')),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('SMTP Setting')->description('asd')->schema([
                TextInput::make('mail_host')->label('SMTP Host')->required(),
                TextInput::make('mail_port')->label('SMTP Port')->required(),
                   TextInput::make('mail_username')->label('SMTP Username')->password()->revealable(),
                TextInput::make('mail_password')->label('SMTP Password')->password()->revealable(),
                ])->columns(4),
           Fieldset::make()->schema([

                Select::make('mail_encryption')->options([
                    'tls' => 'TLS',
                    'ssl' => 'SSL',
                    null => 'None',
                ])->label('SMTP Encryption'),

                TextInput::make('mail_from_address')->label('SMTP From Address'),
                    ToggleButtons::make('status')->boolean()->label('Active')->inline(),
                ])->columns(3),

            ])
            ->statePath('data');
    }

    public function submit()
    {
    $smtpData = $this->form->getState();
       $jsonToStore = [
        [
            'type' => 'keys',
            'data' => [
                'mail_host' => $smtpData['mail_host'],
                'mail_port' => $smtpData['mail_port'],
                'mail_encryption' => $smtpData['mail_encryption'],
                'mail_username' => $smtpData['mail_username'],
                'mail_password' => $smtpData['mail_password'],
                'mail_from_address' => $smtpData['mail_from_address'],
                // 'mail_from_name' => $smtpData['mail_from_name'],
            ],
        ],
    ];

     foreach ($jsonToStore[0]['data'] as $key => $value) {
            if (!is_null($value)) {
                $this->setEnvValue($key, $value);
            }
        }


    SettingWeb::updateOrCreate(
        ['key' => 'smtp'],
        [
            'value' => $jsonToStore,
            'status' => $smtpData['status'] ? 1 : 0,
        ]
    );
    Notification::make()
                ->title('SMTP settings saved.')
                ->success()
                ->send();

    if(ENV('APP_ENV') == 'production'){

    }

    }

      protected function setEnvValue($key, $value)
    {
        $keys = Str::upper($key);
        $path = base_path('.env');
        $escaped = preg_quote("{$keys}=", '/');

        $envContents = file_get_contents($path);

        if (preg_match("/^{$escaped}.*/m", $envContents)) {
            $envContents = preg_replace(
                "/^{$escaped}.*/m",
                "{$keys}=\"{$value}\"",
                $envContents
            );
        } else {
            $envContents .= "\n{$keys}=\"{$value}\"";
        }

        file_put_contents($path, $envContents);

        Artisan::call('config:clear');
        Artisan::call('cache:clear');

    }
}
