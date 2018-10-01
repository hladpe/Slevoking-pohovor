<?php

namespace App\Models\Collections\Filters;

/**
 * Class FacoCorrectCalculationFilter
 * @package App\Models\Collections\Filters
 */
class FeckoCorrectMathCalculationFilter extends \FilterIterator
{
	/**
	 * @return bool
	 */
	public function accept()
	{
		return $this->getInnerIterator()
			->current()
			->getMath()
			->isCorrect();
	}
}
