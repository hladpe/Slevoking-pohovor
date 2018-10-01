<?php

namespace App\Models\Collections;

use App\Models\Interfaces\ICollection;

/**
 * Class BaseCollection
 * @package App\Models\Collections
 */
class BaseCollection extends \stdClass implements \ArrayAccess, \Countable, \IteratorAggregate, ICollection
{
	/**
	 * @var array
	 */
	protected $items = [];

	/**
	 * BaseCollection constructor.
	 * @param array $items
	 * @throws \Exception
	 */
	public function __construct(array $items = [])
	{
		$this->setup($items);
	}

	/**
	 * @param array $items
	 * @throws \Exception
	 */
	protected function setup(array $items)
	{
		foreach ($items as $item) {
			$this->items = array_values($item);
		}
	}

	/**
	 * @return \RecursiveArrayIterator|\Traversable
	 */
	public function getIterator()
	{
		return new \RecursiveArrayIterator($this->items);
	}

	/**
	 * @return int
	 */
	public function count()
	{
		return count($this->items);
	}

	/**
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function offsetSet($key, $value)
	{
		if (is_null($key)) {
			$this->items[] = $value;
		} else {
			$this->items[$key] = $value;
		}
	}

	/**
	 * @param mixed $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		return $this->items[$key];
	}

	/**
	 * @param mixed $key
	 * @return bool
	 */
	public function offsetExists($key)
	{
		return isset($this->items[$key]);
	}

	/**
	 * @param mixed $key
	 */
	public function offsetUnset($key)
	{
		unset($this->items[$key]);
	}

	/**
	 * @param \Iterator $iterator
	 * @return ICollection
	 * @throws \Exception
	 */
	protected function fillByIterator(\Iterator $iterator)
	{
		foreach ($iterator as $item) {
			$this[] = $item;
		}
		return $this;
	}
}
