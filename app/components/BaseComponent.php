<?php

namespace App\Components;

use Nette\Application\UI\Control;

/**
 * Class BaseComponent
 * @package App\Components
 */
abstract class BaseComponent extends Control
{
	/**
	 * Sets local template file in component directory
	 */
	protected function setLocalTemplateFile()
	{
		$reflection = $this->getReflection();
		$file = str_replace('.php', '.latte', $reflection->getFileName());
		$this->template->setFile($file);
	}
}
