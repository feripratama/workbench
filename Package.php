<?php namespace Jackiedo\Workbench;

class Package
{

    /**
     * The vendor name of the package.
     *
     * @var string
     */
    public $vendor;

    /**
     * The snake-cased version of the vendor.
     *
     * @var string
     */
    public $lowerVendor;

    /**
     * The snake_cased version of the vendor.
     *
     * @var string
     */
    public $snakeVendor;

    /**
     * The camelCased version of the vendor.
     *
     * @var string
     */
    public $camelVendor;

    /**
     * The name of the package.
     *
     * @var string
     */
    public $name;

    /**
     * The snake-cased version of the package.
     *
     * @var string
     */
    public $lowerName;

    /**
     * The snake_cased version of the package.
     *
     * @var string
     */
    public $snakeName;

    /**
     * The camelCased version of the package.
     *
     * @var string
     */
    public $camelName;

    /**
     * The name of the author.
     *
     * @var string
     */
    public $author;

    /**
     * The email address of the author.
     *
     * @var string
     */
    public $email;

    /**
     * Description for package
     *
     * @var string
     */
    public $description;

    /**
     * Unused namespace resources
     *
     * @var array
     */
    protected $noneNamespaceResources = [];

    /**
     * Used namespace resources
     *
     * @var array
     */
    protected $namespaceResources = [];

    /**
     * Create a new package instance.
     *
     * @param  string  $vendor
     * @param  string  $name
     * @param  string  $author
     * @param  string  $email
     * @param  array   $resources_structure
     *
     * @return void
     */
    public function __construct($vendor, $name, $author, $email, $description, $resources_structure)
    {
        $this->vendor      = $vendor;
        $this->lowerVendor = snake_case($vendor, '-');
        $this->snakeVendor = snake_case($vendor, '_');
        $this->camelVendor = camel_case($vendor);

        $this->name      = $name;
        $this->lowerName = snake_case($name, '-');
        $this->snakeName = snake_case($name, '_');
        $this->camelName = camel_case($name);

        $this->author = $author;
        $this->email  = $email;

        $this->description = $description;

        $this->namespaceResources     = $resources_structure['with_namespace'];
        $this->noneNamespaceResources = $resources_structure['without_namespace'];
    }

    /**
     * Get the full package name.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->lowerVendor.'/'.$this->lowerName;
    }

    /**
     * Get unused namespace resources
     *
     * @return array
     */
    public function getNoneNamespaceResources()
    {
        return $this->noneNamespaceResources;
    }

    /**
     * Get used namespace resources
     *
     * @return array
     */
    public function getNamespaceResources()
    {
        return $this->namespaceResources;
    }
}
