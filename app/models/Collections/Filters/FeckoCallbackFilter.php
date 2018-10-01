<?php

namespace App\Models\Collections\Filters;

/**
 * Class FacoCallbackFilter
 * @package App\Models\Collections\Filters
 */
class FeckoCallbackFilter extends \FilterIterator
{
	/**
	 * @var \Closure
	 */
	private $filter;

	/**
	 * FacoCallbackFilter constructor.
	 * @param \Iterator $iterator
	 * @param callable $filter
	 */
	public function __construct(\Iterator $iterator, Callable $filter)
	{
		parent::__construct($iterator);
		$this->filter = \Closure::fromCallable($filter);;
	}

	/**
	 * @return bool
	 */
	public function accept()
	{
		$current = $this->getInnerIterator()->current();
		return $this->filter->call($current);
	}
}
