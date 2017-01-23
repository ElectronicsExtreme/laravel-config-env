<?php

namespace ElectronicsExtreme\LaravelConfigEnv\Bootstrap;

use Illuminate\Config\Repository;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Config\Repository as RepositoryContract;
use Illuminate\Foundation\Bootstrap\LoadConfiguration as BaseLoadConfiguration;

class LoadConfiguration extends BaseLoadConfiguration
{
    /**
     * Reserve name for exclude folder from nesting config.
     *
     * @var array
     */
    protected $excludedEnvironmentNesting = ['testing', 'local', 'staging', 'production'];

    /**
     * Load the configuration items from all of the files.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Contracts\Config\Repository       $repository
     * @return void
     */
    protected function loadConfigurationFiles(Application $app, RepositoryContract $repository)
    {
        parent::loadConfigurationFiles($app, $repository);

        foreach ($this->getEnvironmentConfigurationFiles($app) as $key => $path) {
            $repository->set($key, array_replace_recursive($repository->get($key), require $path));
        }
    }

    /**
     * Get all of the configuration files excluded environment nesting
     * for the application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return array
     */
    protected function getConfigurationFiles(Application $app)
    {
        $files = [];

        $configPath = realpath($app->configPath());

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
            $nesting = $this->getConfigurationNesting($file, $configPath);

            if ($nesting && $this->isEnvironmentNesting($nesting)) {
                continue;
            }

            $files[$nesting.basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }

    /**
     * NOTE: Laravel 5.4 will remove this method!
     *
     * Get the configuration file nesting path.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo  $file
     * @param  string  $configPath
     * @return string
     */
    protected function getConfigurationNesting(SplFileInfo $file, $configPath)
    {
        $directory = $file->getPath();

        if ($tree = trim(str_replace($configPath, '', $directory), DIRECTORY_SEPARATOR)) {
            $tree = str_replace(DIRECTORY_SEPARATOR, '.', $tree).'.';
        }

        return $tree;
    }

    /**
     * Check environment nesting folder.
     *
     * @param  string $nesting
     *
     * @return bool
     */
    protected function isEnvironmentNesting($nesting)
    {
        return in_array(explode('.', $nesting)[0], $this->excludedEnvironmentNesting);
    }

    /**
     * Get all of the configuration files in environment nesting
     * for the application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return array
     */
    protected function getEnvironmentConfigurationFiles(Application $app)
    {
        $files = [];

        $environment = $app->detectEnvironment(function () {
            return getenv('APP_ENV') ?: 'production';
        });

        $configPath = realpath($app->configPath().DIRECTORY_SEPARATOR.$environment);

        if (! $configPath) {
            return $files;
        }

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
            $nesting = $this->getConfigurationNesting($file, $configPath);

            $files[$nesting.basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }
}
