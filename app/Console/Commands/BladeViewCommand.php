<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BladeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:blade-view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a blade view inside a path with name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $blade_contents = '
        @extends("layouts.app")

        @section("content")
        <div class="container">
            <h1>Página ' . $name . '</h1>
        </div>
        @endsection
        ';

        $path = base_path('resources/views/' . $name);
        $path = $path . '/';

        if (file_exists($path)) {
            File::put($path . 'index.blade.php', $blade_contents);
        }
        File::makeDirectory($path);
        File::put($path . 'index.blade.php', $blade_contents);

        $this->info('Successfuly created. BladeView Name: ' . $name . '; Path: ' . $path);
    }
}
