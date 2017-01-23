# Installation

---

Install the latest version with

```
$ composer install electronics-extreme/laravel-config-env
```

Go to `app/Http/Kernel.php` and override the `$bootstrappers` with

```
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [
    'Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables',
    'ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration',
    'Illuminate\Foundation\Bootstrap\ConfigureLogging',
    'Illuminate\Foundation\Bootstrap\HandleExceptions',
    'Illuminate\Foundation\Bootstrap\RegisterFacades',
    'Illuminate\Foundation\Bootstrap\RegisterProviders',
    'Illuminate\Foundation\Bootstrap\BootProviders',
];
```

Go to `app/Console/Kernel.php` and override the `$bootstrappers` with

```
/**
 * The bootstrap classes for the application.
 *
 * @var array
 */
protected $bootstrappers = [
    'Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables',
    'ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration',
    'Illuminate\Foundation\Bootstrap\ConfigureLogging',
    'Illuminate\Foundation\Bootstrap\HandleExceptions',
    'Illuminate\Foundation\Bootstrap\RegisterFacades',
    'Illuminate\Foundation\Bootstrap\SetRequestForConsole',
    'Illuminate\Foundation\Bootstrap\RegisterProviders',
    'Illuminate\Foundation\Bootstrap\BootProviders',
];
```

**CAUTION!**

If you're using `laravel 5.3` or below please replace

```
'Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables'
```

with

```
'Illuminate\Foundation\Bootstrap\DetectEnvironment'
```
