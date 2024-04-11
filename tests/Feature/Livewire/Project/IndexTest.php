<?php

namespace Tests\Feature\Livewire\Project;

use Livewire\Volt\Volt;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_it_can_render(): void
    {
        $component = Volt::test('project.index');

        $component->assertSee('');
    }
}
