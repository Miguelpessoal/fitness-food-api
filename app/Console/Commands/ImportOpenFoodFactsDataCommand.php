<?php

namespace App\Console\Commands;

use App\Services\CreateProductService;
use Illuminate\Console\Command;
use ZipArchive;

class ImportOpenFoodFactsDataCommand extends Command
{
    protected $signature = 'import:data';

    protected $description = 'This command will import the most recent data from Open Food Facts';

    public function handle()
    {
        $url =
            'https://static.openfoodfacts.org/data/openfoodfacts-products.jsonl.gz';
        $path = storage_path('temp/openfoodfacts-products.jsonl.gz');

        $content = file_get_contents($url);
        file_put_contents($path, $content);

        $zip = new ZipArchive();
        $res = $zip->open($path);

        if ($res === true) {
            $zip->extractTo(storage_path('temp'));
            $zip->close();
        }

        $path = 'temp/openfoodfacts-products.jsonl';

        $createProductService = app(CreateProductService::class);
        $createProductService->run($path);
    }
}
