<?php

namespace App\Models\Collections;

use stdClass;
use App\Models\Entities\FeckoEntity;
use App\Models\Interfaces\ICollection;
use App\Models\Collections\Filters;

/**
 * Class FeckoCollection
 * @package App\Models\Collections
 */
class FeckoCollection extends BaseCollection
{
	/**
	 * @param array $items
	 * @throws \Exception
	 */
	protected function setup(array $items)
	{
		foreach ($items as $item) {
		    if ($item instanceof stdClass) {
		    	$this->items[] = new FeckoEntity($item);
			} elseif ($item instanceof FeckoEntity) {
				$this->items[] = $item;
			}
		}
	}

	/**
	 * @param array $filter
	 * @return ICollection
	 * @throws \Exception
	 */
	public function filterByReverseName(array $filter)
	{
		$instance = new $this();
		$iterator = new Filters\FeckoReverseNameFilter(
			$this->getIterator(),
			$filter
		);
		return $instance->fillByIterator($iterator);
	}

	/**
	 * @param callable $filter
	 * @return ICollection
	 */
	public function filterByCallback(Callable $filter)
	{
		$instance = new $this();
		$iterator = new Filters\FeckoCallbackFilter(
			$this->getIterator(),
			$filter

		);
		return $instance->fillByIterator($iterator);
	}

	/**
	 * @param \DatePeriod $filter
	 * @return ICollection
	 */
	public function filterByCreatedPeriod(\DatePeriod $filter)
	{
		$instance = new $this();
		$iterator = new Filters\FeckoCreatedPeriodFilter(
			$this->getIterator(),
			$filter
		);
		return $instance->fillByIterator($iterator);
	}

	/**
	 * @return ICollection
	 * @throws \Exception
	 */
	public function filterByCorrectMathCalculation()
	{
		$instance = new $this();
		$iterator = new Filters\FeckoCorrectMathCalculationFilter(
			$this->getIterator()
		);
		return $instance->fillByIterator($iterator);
	}
}
