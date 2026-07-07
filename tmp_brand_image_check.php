<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Brand;

$brands = Brand::select('id', 'brandname', 'image')->get();
foreach ($brands as $brand) {
    echo $brand->id . '|' . $brand->brandname . '|' . $brand->image . PHP_EOL;
}
