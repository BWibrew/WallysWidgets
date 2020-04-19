<?php

namespace Tests\Feature;

use Tests\TestCase;

class PackSizeCalculatorTest extends TestCase
{
    public function testDisplayForm(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('calculator');
        $response->assertSeeText('Wally\'s Widgets', false);
    }

    public function testFormSubmits(): void
    {
        $response = $this->get('/?widget-count=501');

        $response->assertStatus(200);
        $response->assertSeeText('501 widgets require:');
        $response->assertSee('<th scope="row">500</th>', false);
        $response->assertSee('<th scope="row">250</th>', false);
        $response->assertSee('<td>1</td>', false);
        $response->assertSee('<td>1</td>', false);
    }

    public function testWidgetCountIsNumeric(): void
    {
        $response = $this->get('/?widget-count=foo');

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'widget-count' => 'The widget-count must be a number.',
        ]);
    }

    public function testWidgetCountIsGreaterThanZero(): void
    {
        $response = $this->get('/?widget-count=0');

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'widget-count' => 'The widget-count must be greater than 0.',
        ]);
    }
}
