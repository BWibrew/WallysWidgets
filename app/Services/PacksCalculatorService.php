<?php

namespace App\Services;

class PacksCalculatorService
{
    /** @var array Available widget pack sizes. */
    protected $packSizes;

    /** @var int Smallest available widget pack size. */
    protected $smallestPackSize;

    /** @var int Largest available widget pack size. */
    protected $largestPackSize;

    /** @var array Widget pack sizes and their quantities. */
    protected $order = [];

    /**
     * PacksCalculatorService constructor.
     * @param array $packSizes
     */
    public function __construct(array $packSizes)
    {
        sort($packSizes);
        $this->packSizes = $packSizes;
        $this->smallestPackSize = $packSizes[0];
        $this->largestPackSize = $this->packSizes[count($this->packSizes) - 1];
    }

    /**
     * Calculate the size and quantity of packs.
     * @param int $widgetCount
     * @return $this
     */
    public function calculateOrder(int $widgetCount): PacksCalculatorService
    {
        if ($this->matchesWholePackSize($widgetCount)) {
            $this->updateOrder($widgetCount);

            return $this;
        }

        if ($widgetCount <= $this->smallestPackSize) {
            $this->updateOrder($this->smallestPackSize);

            return $this;
        }

        $largestSize = $this->getLargestSinglePackSize($widgetCount);

        $previousPackSize = $largestSize === null ? $this->largestPackSize : $this->getPreviousPackSize($largestSize);

        $this->updateOrder($previousPackSize);

        if (($remainingWidgets = $widgetCount - $previousPackSize) > 0) {
            $this->calculateOrder($remainingWidgets);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * Get the largest possible whole pack size or null if greater than largest pack.
     * @param int $widgetCount
     * @return int|null
     */
    protected function getLargestSinglePackSize(int $widgetCount): ?int
    {
        foreach ($this->packSizes as $packSize) {
            if ($packSize >= $widgetCount) {
                return $packSize;
            }
        }

        return null;
    }

    /**
     * Get the previous largest pack size.
     * @param int $currentSize
     * @return int
     */
    protected function getPreviousPackSize(int $currentSize): int
    {
        return $this->packSizes[array_search($currentSize, $this->packSizes, true) - 1];
    }

    /**
     * Update the pack sizes and quantities on the order.
     * @param int $packSize
     */
    protected function updateOrder(int $packSize): void
    {
        if (array_key_exists($packSize, $this->order)) {
            ++$this->order[$packSize];
            if (in_array($this->order[$packSize] * $packSize, $this->packSizes, true)) {
                $this->updateOrder($this->order[$packSize] * $packSize);
                unset($this->order[$packSize]);
            }
        } else {
            $this->order[$packSize] = 1;
        }
    }

    /**
     * Determine if requested widget count is equal to a pack size.
     * @param int $widgetCount
     * @return bool
     */
    protected function matchesWholePackSize(int $widgetCount): bool
    {
        return in_array($widgetCount, $this->packSizes, true);
    }
}
