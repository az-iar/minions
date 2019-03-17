<?php

namespace Minions\Test\Unit\Client;

use Minions\Client\Minion;
use Minions\Client\Project;
use PHPUnit\Framework\TestCase;

class MinionTest extends TestCase
{
    /** @test */
    public function it_can_configure_existing_project()
    {
        $minion = new Minion([
            'id' => 'foobar',
            'projects' => [
                'platform' => [
                    'endpoint' => 'https://127.0.0.1:6005',
                    'token' => 'secret',
                    'signature' => 'secret',
                ],
            ],
        ]);

        $project = $minion->project('platform');

        $this->assertInstanceOf(Project::class, $project);
    }

    /** @test */
    public function it_cant_configure_none_existing_project()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Unable to find project [katsana].');

        $minion = new Minion([
            'id' => 'foobar',
            'projects' => [
                'platform' => [
                    'endpoint' => 'https://127.0.0.1:6005',
                    'token' => 'secret',
                    'signature' => 'secret',
                ],
            ],
        ]);

        $project = $minion->project('katsana');
    }
}
