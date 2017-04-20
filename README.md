# Installation

---

Install the latest version with

```
$ composer require electronics-extreme/laravel-config-env
```

Go to `app/Http/Kernel.php` and override the `$bootstrappers` with

**`Laravel 5.4`**

```
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    \ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
    \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    \Illuminate\Foundation\Bootstrap\BootProviders::class,
];
```

**`laravel 5.3` or below**

```
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [    
    'Illuminate\Foundation\Bootstrap\DetectEnvironment',
    'ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration',
    'Illuminate\Foundation\Bootstrap\ConfigureLogging',
    'Illuminate\Foundation\Bootstrap\HandleExceptions',
    'Illuminate\Foundation\Bootstrap\RegisterFacades',
    'Illuminate\Foundation\Bootstrap\RegisterProviders',
    'Illuminate\Foundation\Bootstrap\BootProviders',
];
```

Go to `app/Console/Kernel.php` and override the `$bootstrappers` with

**`laravel 5.4`**

```
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [
    \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
    \ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration::class,
    \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
    \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
    \Illuminate\Foundation\Bootstrap\SetRequestForConsole::class,
    \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
    \Illuminate\Foundation\Bootstrap\BootProviders::class,
];
```

**`laravel 5.3` or below**

```
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [
    'Illuminate\Foundation\Bootstrap\DetectEnvironment',
    'ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration',
    'Illuminate\Foundation\Bootstrap\ConfigureLogging',
    'Illuminate\Foundation\Bootstrap\HandleExceptions',
    'Illuminate\Foundation\Bootstrap\RegisterFacades',
    'Illuminate\Foundation\Bootstrap\SetRequestForConsole',
    'Illuminate\Foundation\Bootstrap\RegisterProviders',
    'Illuminate\Foundation\Bootstrap\BootProviders',
];
```
