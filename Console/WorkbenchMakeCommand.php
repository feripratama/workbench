<?php namespace Jackiedo\Workbench\Console;

use Illuminate\Console\Command;
use Jackiedo\Workbench\Package;
use Jackiedo\Workbench\PackageCreator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class WorkbenchMakeCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'workbench';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package workbench';

    /**
     * The package creator instance.
     *
     * @var \Jackiedo\Workbench\PackageCreator
     */
    protected $creator;

    /**
     * Step of process
     *
     * @var integer
     */
    protected $step = 0;

    /**
     * Create a new make workbench command instance.
     *
     * @param  \Jackiedo\Workbench\PackageCreator  $creator
     * @return void
     */
    public function __construct(PackageCreator $creator)
    {
        parent::__construct();

        $this->creator = $creator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info(PHP_EOL.'>>> Please step by step provide following informations:');

        $workbench = $this->runCreator($this->buildPackage());

        $this->info(PHP_EOL.'>>> Wow! Your package workbench is created and storaged at '.$workbench.PHP_EOL);

        $this->callComposerUpdate($workbench);
    }

    /**
     * Run the package creator class for a given Package.
     *
     * @param  \Jackiedo\Workbench\Package  $package
     * @return string
     */
    protected function runCreator($package)
    {
        $path = $this->laravel['path.base'].'/workbench';
        $config = $this->laravel['config']['workbench'];

        if (!array_key_exists('point_namespace_to_similar_dir', $config) || !is_bool($config['point_namespace_to_similar_dir'])) {
            $pointNsToSimilarDir = $this->confirm(++$this->step.'. Do you want PSR-4 autoloading standard for namespace '.$package->vendor.'\\'.$package->name.' in the composer.json file is pointed to the src/'.$package->vendor.'/'.$package->name.' directory (if say no, this will be pointed to the src directory)?', true);
        } else {
            $pointNsToSimilarDir = $config['point_namespace_to_similar_dir'];
        }

        $chosenResources = [];
        if ($this->option('resources')) {
            $this->question(' '.++$this->step.'. Which of the following resources would you like to generate?');

            $allResources = $config['resources']['with_namespace'] + $config['resources']['without_namespace'];
            $chosenResources = $this->askForResources($allResources);
        }

        $this->info(PHP_EOL.'>>> Thanks for your informations. Package is being generated, please wait...');

        return $this->creator->create($package, $path, $chosenResources, $pointNsToSimilarDir);
    }

    /**
     * Call the composer update routine on the path.
     *
     * @param  string  $path
     * @return void
     */
    protected function callComposerUpdate($path)
    {
        chdir($path);

        // passthru('composer install --dev');
        passthru('composer dump-autoload');
    }

    /**
     * Build the package details from user input.
     *
     * @return \Jackiedo\Workbench\Package
     *
     * @throws \UnexpectedValueException
     */
    protected function buildPackage()
    {
        list($vendor, $name) = $this->getPackageSegments();

        $config = $this->laravel['config']['workbench'];

        // Get author name
        $author_name = (empty($this->option('author-name'))) ? ((empty($config['name'])) ? $this->ask(++$this->step.'. What is your name?') : $config['name']) : $this->option('author-name');

        // Get author email
        $author_email = (empty($this->option('author-email'))) ? ((empty($config['email'])) ? $this->ask(++$this->step.'. Hi '.$author_name.'! What is your e-mail address?') : $config['email']) : $this->option('author-email');

        // Get description for package
        $description = $this->ask(++$this->step.'. You can provide a short descripton for your package here if you want:', 'The '.$name.' package');

        // Get structure of package resources
        $resources_structure = $config['resources'];

        return new Package($vendor, $name, $author_name, $author_email, $description, $resources_structure);
    }

    /**
     * Ask for choosing resources
     *
     * @param  array $resources
     *
     * @return array
     */
    protected function askForResources($resources)
    {
        $choices = [];

        foreach ($resources as $type => $path) {
            if ($this->confirm(' - ' .ucfirst(strtolower($type)). '?', true)) {
                $choices[] = $type;
            }
        }

        return $choices;
    }

    /**
     * Get the package vendor and name segments from the input.
     *
     * @return array
     */
    protected function getPackageSegments()
    {
        $package = $this->argument('package');

        $parsed = array_map('studly_case', explode('/', $package, 2));

        if (!isset($parsed[1]) || empty($parsed[1])) {
            throw new \InvalidArgumentException("The package argument must be of the form [vendor/name]");
        }

        return $parsed;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('package', InputArgument::REQUIRED, 'The fullname (vendor/name) of the package.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('resources', null, InputOption::VALUE_NONE, 'Create Laravel specific directories.'),
            array('author-name', null, InputOption::VALUE_OPTIONAL, 'Author\'s name of package.'),
            array('author-email', null, InputOption::VALUE_OPTIONAL, 'Author\'s email of package.'),
        );
    }
}
