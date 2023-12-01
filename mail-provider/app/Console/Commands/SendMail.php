<?php

namespace App\Console\Commands;

use App\Mail\AccountDeletion;
use App\Mail\AccountWillDeletion;
use App\Mail\Maintenance;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    private const TYPES = [
        'Account Deletion' => 0,
        'Account Will Deletion' => 1,
        'Maintenance Notification' => 2,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mock mails.';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle()
    {
        $type = $this->choice(
            'What type of email?',
            array_keys(self::TYPES),
            Arr::random(array_keys(self::TYPES), 1)[0]
        );
        $locale = $this->choice('Which locale?', ['ja', 'en'], 'ja');

        $mail = match ($type) {
            'Account Deletion' => AccountDeletion::class,
            'Account Will Deletion' => AccountWillDeletion::class,
            'Maintenance Notification' => Maintenance::class,
            default => throw new Exception('Unexpected match value'),
        };

        Mail::to(fake($locale)->safeEmail())
            ->locale($locale)
            ->send(new $mail);
    }
}
