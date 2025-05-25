<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GetDataFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy resources/js/Data files into public/storage/data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $source = resource_path('js/Data');
        $destination = public_path('storage/data');

        File::ensureDirectoryExists($destination);
        File::copyDirectory($source, $destination);

        $this->info('Data files copied into public/storage/data.');
    }
}
