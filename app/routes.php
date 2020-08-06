<?php

use App\Actions;
use livetyping\hermitage\app\middleware\Authenticate;
use Slim\HttpCache\Cache;

$app->get('/{filename:.+}', Actions\GetAction::class)->add(Cache::class);

$app->group('/', function () {
    $this->post('', Actions\StoreAction::class);
    $this->delete('{filename:.+}', Actions\DeleteAction::class);
})->add(Authenticate::class);
