<?php

namespace App\Models\Collections\Filters;

/**
 * Class FacoReverseNameFilter
 * @package App\Models\Collections\Filters
 */
class FeckoReverseNameFilter extends \FilterIterator
{
	/**
	 * @var array
	 */
	private $filter;

	/**
	 * FacoReverseNameFilter constructor.
	 * @param \Iterator $iterator
	 * @param array $filter
	 */
	public function __construct(\Iterator $iterator, array $filter)
	{
		parent::__construct($iterator);
		$this->filter = $filter;
	}

	/**
	 * @return bool
	 */
	public function accept()
	{
		$current = $this->getInnerIterator()->current();
		$reversedName = strrev( $current->getName() );
		return in_array($reversedName, $this->filter, true);
	}
}
