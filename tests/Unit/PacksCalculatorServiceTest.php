<?php

namespace Tests\Unit;

use App\Services\PacksCalculatorService;
use PHPUnit\Framework\TestCase;

class PacksCalculatorServiceTest extends TestCase
{
    public function test1WidgetGives250PackSize(): void
    {
        $this->assertEquals(
            [[
                'packSize' => 250,
                'quantity' => 1,
            ]],
            (new PacksCalculatorService([250, 500, 1000, 2000, 5000]))->calculateOrder(1)->getOrder()
        );
    }

    public function test250WidgetsGives250PackSize(): void
    {
        $this->assertEquals(
            [[
                'packSize' => 250,
                'quantity' => 1,
            ]],
            (new PacksCalculatorService([250, 500, 1000, 2000, 5000]))->calculateOrder(250)->getOrder()
        );
    }

    public function test251WidgetsGives500PackSize(): void
    {
        $this->assertEquals(
            [[
                'packSize' => 500,
                'quantity' => 1,
            ]],
            (new PacksCalculatorService([250, 500, 1000, 2000, 5000]))->calculateOrder(251)->getOrder()
        );
    }

    public function test501WidgetsGives250And500PackSize(): void
    {
        $this->assertEquals(
            [
                [
                    'packSize' => 250,
                    'quantity' => 1,
                ],
                [
                    'packSize' => 500,
                    'quantity' => 1,
                ],
            ],
            (new PacksCalculatorService([250, 500, 1000, 2000, 5000]))->calculateOrder(501)->getOrder()
        );
    }

    public function test12001WidgetsGives250And2000And5000And5000(): void
    {
        $this->assertEquals(
            [
                [
                    'packSize' => 250,
                    'quantity' => 1,
                ],
                [
                    'packSize' => 2000,
                    'quantity' => 1,
                ],
                [
                    'packSize' => 5000,
                    'quantity' => 2,
                ],
            ],
            (new PacksCalculatorService([250, 500, 1000, 2000, 5000]))->calculateOrder(12001)->getOrder()
        );
    }
}
