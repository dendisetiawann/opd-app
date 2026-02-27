<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$col = DB::select("SHOW COLUMNS FROM health_check_batches WHERE Field = 'status'");
echo "Type: " . $col[0]->Type . "\n";
