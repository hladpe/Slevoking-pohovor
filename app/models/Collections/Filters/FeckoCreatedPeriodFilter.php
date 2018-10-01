<?php

namespace App\Models\Collections\Filters;

/**
 * Class FacoCreatedFilter
 * @package App\Models\Collections\Filters
 */
class FeckoCreatedPeriodFilter extends \FilterIterator
{
	/**
	 * @var \DatePeriod
	 */
	private $filter;

	/**
	 * FacoCreatedFilter constructor.
	 * @param \Iterator $iterator
	 * @param \DatePeriod $filter
	 */
	public function __construct(\Iterator $iterator, \DatePeriod $filter)
	{
		parent::__construct($iterator);
		$this->filter = $filter;
	}

	/**
	 * @return bool
	 */
	public function accept()
	{
		$current = $this->getInnerIterator()
			->current()
			->getCreated();

		foreach ($this->filter as $filter) {
		    if ($current == $filter) {
		    	return true;
			}
		}
		return false;
	}
}
