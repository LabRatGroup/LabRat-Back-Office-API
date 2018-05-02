<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_CONNECTION=sqlite_testing');
        putenv('JWT_SECRET=HHs01dhYDQ60cZqN5xAXfTv2YWJ4kv68');
        putenv('QUEUE_DRIVER=database');
        putenv('APP_KEY=base64:lxhhUFB1SL6mpIoOurC29CpvQDXKDTjY7dnQTCsISHI=');

        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::driver('bcrypt')->setRounds(4);

        return $app;
    }
}
