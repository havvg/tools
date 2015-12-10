<?php

namespace Havvg\Tools\Tests\Filesystem;

use Havvg\Tools\Filesystem\TemporaryDirectory;

/**
 * @covers \Havvg\Tools\Filesystem\TemporaryDirectory
 */
class TemporaryDirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function testStringRepresentsDirectory()
    {
        $directory = new TemporaryDirectory('test');

        static::assertNotEmpty((string) $directory, 'TemporaryDirectory implements __toString()');
    }

    /**
     * @depends testStringRepresentsDirectory
     */
    public function testDirectoryIsCreated()
    {
        $directory = new TemporaryDirectory('test');

        static::assertTrue(is_dir($directory), 'The directory has been created.');
        static::assertStringStartsWith(sys_get_temp_dir(), (string) $directory, 'The directory has been created in the system temporary directory.');
    }

    /**
     * @depends testDirectoryIsCreated
     */
    public function testDirectoryIsRemoved()
    {
        $directory = (string) (new TemporaryDirectory('test'));

        static::assertFalse(is_dir($directory));
    }

    /**
     * @depends testDirectoryIsCreated
     */
    public function testRootingIntoCustomDirectory()
    {
        $rootDirectory = new TemporaryDirectory('test_root');
        $directory = new TemporaryDirectory('test', (string) $rootDirectory);

        static::assertStringStartsWith((string) $rootDirectory, (string) $directory, 'The directory has been created in the custom directory.');
    }
}
