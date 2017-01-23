<?php

use ElectronicsExtreme\LaravelConfigEnv\Bootstrap\LoadConfiguration;

class LoadConfigurationTest extends TestCase
{
    public function setUp()
    {
        $this->loadConfiguration = new LoadConfiguration();
        $this->configPath = __DIR__.'/config';
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_load_configuration_files()
    {
        $app = Mockery::mock('Illuminate\Contracts\Foundation\Application');
        $app->shouldReceive('configPath')
            ->withNoArgs()
            ->andReturn($this->configPath)
            ->shouldReceive('detectEnvironment')
            ->once()
            ->andReturn('testing');

        $repository = Mockery::mock('Illuminate\Contracts\Config\Repository');
        $repository->shouldReceive('set')
            ->twice()
            ->shouldReceive('get')
            ->once()
            ->andReturn([]);

        $result = $this->callMethod($this->loadConfiguration, 'loadConfigurationFiles', [$app, $repository]);

        $this->assertNull($result);
    }

    public function test_get_configuration_files()
    {
        $app = Mockery::mock('Illuminate\Contracts\Foundation\Application');
        $app->shouldReceive('configPath')
            ->once()
            ->withNoArgs()
            ->andReturn($this->configPath);

        $result = $this->callMethod($this->loadConfiguration, 'getConfigurationFiles', [$app]);

        $this->assertArrayHasKey('sample', $result);
        $this->assertArrayNotHasKey('testing.sample', $result);
        $this->assertEquals($this->configPath.'/sample.php', $result['sample']);
    }

    public function test_is_environment_nesting_false()
    {
        $result = $this->callMethod($this->loadConfiguration, 'isEnvironmentNesting', ['bobo']);
        $this->assertFalse($result);
    }

    public function test_is_environment_nesting_true()
    {
        $result = $this->callMethod($this->loadConfiguration, 'isEnvironmentNesting', ['local']);
        $this->assertTrue($result);
    }

    public function test_get_environment_configuration_files()
    {
        $app = Mockery::mock('Illuminate\Contracts\Foundation\Application');
        $app->shouldReceive('configPath')
            ->once()
            ->withNoArgs()
            ->andReturn($this->configPath)
            ->shouldReceive('detectEnvironment')
            ->once()
            ->andReturn('testing');

        $result = $this->callMethod($this->loadConfiguration, 'getEnvironmentConfigurationFiles', [$app]);

        $this->assertArrayHasKey('sample', $result);
        $this->assertArrayNotHasKey('testing.sample', $result);
        $this->assertEquals($this->configPath.'/testing/sample.php', $result['sample']);
    }

    public function test_get_environment_configuration_files_without_folder()
    {
        $app = Mockery::mock('Illuminate\Contracts\Foundation\Application');
        $app->shouldReceive('configPath')
            ->once()
            ->withNoArgs()
            ->andReturn($this->configPath)
            ->shouldReceive('detectEnvironment')
            ->once()
            ->andReturn('staging');

        $result = $this->callMethod($this->loadConfiguration, 'getEnvironmentConfigurationFiles', [$app]);

        $this->assertEmpty($result);
    }
}
