<?php

namespace Havvg\Tools\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

final class TemporaryDirectory
{
    /**
     * @var string
     */
    private $directory;

    /**
     * Constructor.
     *
     * Generates, creates and references a temporary directory.
     *
     * @param string      $prefix
     * @param string|null $rootPath The basepath to root the temporary directory into. Defaults to the system temp directory.
     */
    public function __construct($prefix, $rootPath = null)
    {
        if (null === $rootPath) {
            $rootPath = sys_get_temp_dir();
        }

        $this->directory = $rootPath.DIRECTORY_SEPARATOR.uniqid($prefix);

        $fs = new Filesystem();
        $fs->mkdir($this->directory);
    }

    /**
     * Destructor.
     *
     * Removes the temporary directory.
     */
    public function __destruct()
    {
        $fs = new Filesystem();
        $fs->remove($this->directory);
    }

    /**
     * Returns the full path of the temporary directory.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->directory;
    }
}
