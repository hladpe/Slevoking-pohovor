<?php

namespace App\Models\Entities;

use App\Models\Entities\FeckoEntity\Math;
use App\Models\Interfaces\IEntity;
use Nette\Utils\DateTime;
use stdClass;

/**
 * Class FeckoCollection
 * @package App\Models\Collections
 */
class FeckoEntity implements IEntity
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var int
	 */
	private $first;

	/**
	 * @var int
	 */
	private $second;

	/**
	 * @var int
	 */
	private $third;

	/**
	 * @var Math
	 */
	private $math;

	/**
	 * @var DateTime
	 */
	private $created;

	/**
	 * FeckoEntity constructor.
	 * @param null|stdClass $item
	 * @throws \Exception
	 */
	public function __construct(?stdClass $item = null)
	{
		if (!is_null($item)) {
			$this->setup($item);
		}
	}

	/**
	 * @param stdClass $item
	 * @throws \Exception
	 */
	private function setup(stdClass $item)
	{
		$this->setId((int) $item->id)
			->setName((string) $item->name)
			->setFirst((int) $item->first)
			->setSecond((int) $item->second)
			->setThird((int) $item->third)
			->setMath(
				new Math($item->math)
			)
			->setCreated(
				new DateTime($item->created)
			);
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return $this
	 */
	public function setId(int $id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setName(string $name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getFirst()
	{
		return $this->first;
	}

	/**
	 * @param int $first
	 * @return $this
	 */
	public function setFirst(int $first)
	{
		$this->first = $first;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getSecond()
	{
		return $this->second;
	}

	/**
	 * @param int $second
	 * @return $this
	 */
	public function setSecond(int $second)
	{
		$this->second = $second;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getThird()
	{
		return $this->third;
	}

	/**
	 * @param int $third
	 * @return $this
	 */
	public function setThird(int $third)
	{
		$this->third = $third;
		return $this;
	}

	/**
	 * @return Math
	 */
	public function getMath()
	{
		return $this->math;
	}

	/**
	 * @param Math $math
	 * @return $this
	 */
	public function setMath(Math $math)
	{
		$this->math = $math;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * @param DateTime $created
	 * @return $this
	 */
	public function setCreated(DateTime $created)
	{
		$this->created = $created;
		return $this;
	}
}
