<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\SettingWeb;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
class GeneralSetup extends Page implements Forms\Contracts\HasForms
{
    use HasPageShield,Forms\Concerns\InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-s-cog';
    protected static ?string $title = 'Configuration';
    protected ?string $heading = 'Configuration';
    protected ?string $subheading = 'Configuration General';
    protected static ?string $navigationGroupLabel = 'Configuration';
    protected static string $view = 'filament.pages.general-setup';
    protected static bool $isLazy = true;

    public ?array $websiteForm = [];
    public ?array $mailForm = [];
    public ?array $otherForm = [];
    public ?array $apiForm = [];

    public function mount(): void
    {
        $this->getFormMail()->fill([
            'status' => \App\Models\SettingWeb::where('key', 'smtp')->value('status') ?? true,
            'mail_host' => smtp_setting('mail_host', env('MAIL_HOST')),
            'mail_host' => smtp_setting('mail_host', env('MAIL_HOST')),
            'mail_port' => smtp_setting('mail_port', env('MAIL_PORT')),
            'mail_encryption' => smtp_setting('mail_encryption', env('MAIL_ENCRYPTION')),
            'mail_username' => smtp_setting('mail_username', env('MAIL_USERNAME')),
            'mail_password' => smtp_setting('mail_password', env('MAIL_PASSWORD')),
            'mail_from_address' => smtp_setting('mail_from_address', env('MAIL_FROM_ADDRESS')),
        ]);
        $fill = SettingWeb::where('key', 'website-setup')->first()->toArray();
        $this->websiteForm = $fill['value'][0]['data'] ?? [];
        $this->getFormAPI()->fill();
        $this->getFormOther()->fill();
    }

    // #[Lazy('getFormWebsite')]
    public function getFormWebsite(): Form
    {
        return $this->makeForm()
            ->schema([
                    Tabs::make('Tabs')->contained(true)
                        ->tabs([
                            Tabs\Tab::make('General')->icon('heroicon-o-globe-alt')
                                ->schema([
                                        Section::make('Website Settings')->aside()->description('Website Settings')->columns(1)->schema([
                                            ToggleButtons::make('status')->boolean()->label('Active')->inline(),
                                            Fieldset::make('App Development')->columns(2)->schema([
                                            TextInput::make('app_name')->label('App Name')->datalist([
                                                                // 'Padang-CSIRT',
                                                                // 'Jakarta-CSIRT',
                                                                // 'Bandung-CSIRT',
                                                            ]),
                                                TextInput::make('app_env')->label('App ENV'),
                                                TextInput::make('app_debug')->label('App Debug'),
                                                TextInput::make('app_timezone')->label('App Timezone'),

                                                TextInput::make('app_url')->label('App URL'),
                                                TextInput::make('app_description')->label('App Description')->autocapitalize('words'),
                                                TextInput::make('app_version')->label('App Version'),
                                                TextInput::make('app_developer')->label('App Developer'),
                                            ]),
                                            Fieldset::make('Media Social')->columns(3)->schema([
                                                TextInput::make('twitter')->label('Twitter'),
                                                TextInput::make('facebook')->label('Facebook'),
                                                TextInput::make('instagram')->label('Instagram'),
                                                TextInput::make('youtube')->label('Youtube'),
                                                TextInput::make('linkedin')->label('Linkedin'),
                                                TextInput::make('tiktok')->label('Tiktok'),
                                                TextInput::make('telegram')->label('Telegram'),
                                                TextInput::make('whatsapp')->label('Whatsapp'),
                                            ]),
                                            Fieldset::make('App Config')->columns(3)->schema([
                                            TextInput::make('site_url')->label('Site URL'),
                                            TextInput::make('site_name')->label('Site Name'),
                                            TextInput::make('copyright')->label('Copyright'),
                                            TextInput::make('author')->label('Author'),
                                            TextInput::make('address')->label('Address'),
                                            TextInput::make('phone')->label('Phone'),
                                            TextInput::make('email')->label('Email'),
                                            TextInput::make('logo')->label('Logo'),
                                            TextInput::make('favicon')->label('Favicon'),
                                            ]),

                                        ])->compact(),
                                ]),
                            Tabs\Tab::make('Footer')->icon('heroicon-m-globe-alt')
                                ->schema([
                                        Section::make('Footer Settings')->aside()->description('Footer Settings')->columns(3)->schema([
                                            TextInput::make('link')->label('Lnk')


                                        ]),
                            ])
                        ]),

                    ])
                    ->statePath('websiteForm');
    }
    
    public function getFormMail(): Form
    {
        return $this->makeForm()
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
            ->statePath('mailForm');
    }

    public function getFormOther(): Form
    {
        return $this->makeForm()
            ->schema([
                Section::make('PGP Settings')->aside()->description('PGP Settings')->columns(1)->schema([
                    ToggleButtons::make('status')->boolean()->label('Active')->inline(),
                    TextArea::make('pgp_key')->label('PGP Key')->placeholder(Str::random(60))->rows(1),
                ]),
            ])
            ->statePath('otherForm');
    }

    public function getFormAPI(): Form
    {
        return $this->makeForm()
            ->schema([
                Section::make('API Settings')->aside()->description('API Settings')->columns(1)->schema([
                    ToggleButtons::make('status')->boolean()->label('Active')->inline(),
                    TextInput::make('api_name')->label('Api Name'),
                    TextInput::make('api_key')->label('Api Key'),
                ]),
            ])->statePath('apiForm');
    }


    public function submitWebsite()
    {
        $generalData = $this->getFormWebsite()->getState();
        $jsonToStore = [
            [
                    'type' => 'website-setup',
                    'data' => [
                        'app_name' => $generalData['app_name'],
                        'app_url' => $generalData['app_url'],
                        'app_description' => $generalData['app_description'],
                        'app_developer' => $generalData['app_developer'],
                        'app_env' => $generalData['app_env'], // production
                        'app_debug' => $generalData['app_debug'],
                        'app_version' => $generalData['app_version'],
                        'app_timezone' => $generalData['app_timezone'], // Asia/Jakarta
                        'site_url' => $generalData['site_url'],
                        'site_name' => $generalData['site_name'],
                        'link' => $generalData['link'],
                        'copyright' => $generalData['copyright'],
                        'author' => $generalData['author'],
                        'status' => $generalData['status'],
                        'address' => $generalData['address'],
                        'phone' => $generalData['phone'],
                        'email' => $generalData['email'],
                        'logo' => $generalData['logo'],
                        'favicon' => $generalData['favicon'],
                        'twitter' => $generalData['twitter'],
                        'facebook' => $generalData['facebook'],
                        'instagram' => $generalData['instagram'],
                        'youtube' => $generalData['youtube'],
                        'linkedin' => $generalData['linkedin'],
                        'tiktok' => $generalData['tiktok'],
                        'telegram' => $generalData['telegram'],
                        'whatsapp' => $generalData['whatsapp'],
                    ],
                ],
            ];

        SettingWeb::updateOrCreate(
            ['key' => 'website-setup'],
                [
                    'value' => $jsonToStore,
                    'status' => $generalData['status'] ? 1 : 0,
                ]
            );
        Notification::make()
            ->title('Pengaturan Website Berhasil Disimpan!')
            ->success()
            ->send();
    }

    public function submitMail()
    {
       $smtpData = $this->getFormMail()->getState();
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

            // if(ENV('APP_ENV') == 'production'){}
    }

    public function submitOther()
    {
        $generalData = $this->getFormOther()->getState();
           $jsonToStore = [
            [
                    'type' => 'pgp-setup',
                    'data' => [
                        'pgp_key' => $generalData['pgp_key'],
                    ],
                ],
            ];
        try {
            SettingWeb::updateOrCreate(
                ['key' => 'pgp-setup'],
                    [
                        'value' => $jsonToStore,
                        'status' => $generalData['status'] ? 1 : 0,
                    ]
                );
                Notification::make()
                    ->title('Pengaturan API Berhasil Disimpan!')
                    ->success()
                    ->send();
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Pengaturan API Gagal Disimpan!')
                ->danger()
                ->send();
        }
    }

    public function submitAPI()
    {
        $generalData = $this->getFormAPI()->getState();
          $jsonToStore = [
            [
                    'type' => 'api-setup',
                    'data' => [
                        'api_name' => $generalData['api_name'],
                        'api_key' => $generalData['api_key'],
                    ],
                ],
            ];
        try {
            SettingWeb::updateOrCreate(
                ['key' => 'api-setup'],
                    [
                        'value' => $jsonToStore,
                        'status' => $generalData['status'] ? 1 : 0,
                    ]
                );
                Notification::make()
                    ->title('Pengaturan API Berhasil Disimpan!')
                    ->success()
                    ->send();
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Pengaturan API Gagal Disimpan!')
                ->danger()
                ->send();
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
