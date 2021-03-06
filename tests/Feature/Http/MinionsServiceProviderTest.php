<?php

namespace Minions\Tests\Feature\Server;

use Minions\Tests\HttpTestCase;

class MinionsServiceProviderTest extends HttpTestCase
{
    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        config([
            'minions' => ['id' => 'minions', 'projects' => [], 'services' => []],
        ]);
    }

    /** @test */
    public function it_register_the_services()
    {
        $this->assertInstanceOf('Minions\Http\Controller', $this->app['minions.controller']);
        $this->assertInstanceOf('Minions\Http\Router', $this->app['minions.router']);
    }
}
