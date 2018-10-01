<?php

namespace App\Models\Entities\FeckoEntity;

/**
 * Class Math
 * @package App\Models\Entities\FeckoEntity
 */
class Math
{
	/**
	 * @var string
	 */
	private $expression;

	/**
	 * @var string
	 */
	private $leftSide;

	/**
	 * @var string
	 */
	private $rightSide;

	/**
	 * Math constructor.
	 * @param string $expression
	 */
	public function __construct(string $expression)
	{
		$this->expression = $expression;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->expression;
	}

	private function setup(): void
	{
		$expression = trim($this->expression);
		$expression = str_replace(',', '.', $expression);
		$expression = preg_replace("/[^0-9\.\+\-\*\/=()\[\]]/", '', $expression);
		$parts = explode('=', $expression);

		if (count($parts) === 2) {
			$this->leftSide = reset($parts);
			$this->rightSide = end($parts);
		}
	}

	/**
	 * @return bool
	 */
	public function isCorrect(): bool
	{
		if (!$this->leftSide || $this->rightSide) {
			$this->setup();
		}
		return $this->calculate($this->leftSide) === $this->calculate($this->rightSide);
	}

	/**
	 * @param string $expression
	 * @return int|float
	 */
	private function calculate(string $expression)
	{
		$compute = create_function("", "return (" . $expression . ");" );
		return 0 + $compute();
	}
}
