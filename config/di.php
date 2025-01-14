<?php

use Google\Client;
use Google\Service\Sheets;

return [
    Sheets::class => function () {
        $client = new Client();
        $client->setApplicationName('Gamer Mel Generators');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig('credentials.json');
        return new Sheets($client);
    }
];