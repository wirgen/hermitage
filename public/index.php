<?php

use livetyping\hermitage\app\App;
use livetyping\hermitage\app\Sources;
use function livetyping\hermitage\bootstrap\load_dotenv;

require __DIR__ . '/../vendor/autoload.php';

$sources = new Sources([
    __DIR__ . '/../config/main.php',
]);

load_dotenv(dirname(__DIR__));
try {
    // Override init app
    $app = new App($sources);
    require __DIR__ . '/../app/routes.php';

    $app->run();
} catch (Throwable $e) {
}
