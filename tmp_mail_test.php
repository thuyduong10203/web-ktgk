<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

Illuminate\Support\Facades\Notification::route('mail', 'hpkimoanh.forwork@gmail.com')
    ->notify(new App\Notifications\TestSendEmail([]));

echo "sent\n";
