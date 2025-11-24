<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

echo "App class: " . get_class($app) . "\n";
echo "App bound services: " . count($app->getBindings()) . "\n";

try {
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    echo "Kernel loaded successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
