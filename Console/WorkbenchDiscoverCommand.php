<?php namespace Jackiedo\Workbench\Console;

use Illuminate\Console\Command;
use Jackiedo\Workbench\Starter;

class WorkbenchDiscoverCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'workbench:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Discover all workbench packages';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $workbench_path = $this->laravel['path.base'].'/workbench';

        Starter::discoverAllPackages($workbench_path);
    }

    /**
     * Alias of the fire() method
     *
     * @return void
     */
    public function handle()
    {
        $this->fire();
    }
}
