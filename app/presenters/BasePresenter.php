<?php

namespace App\Presenters;

use Nittro\Bridges\NittroUI\Presenter;
use Kdyby\Translation\Translator;

/**
 * Class BasePresenter
 * @package App\Presenters
 */
abstract class BasePresenter extends Presenter
{
	/**
	 * @var Translator
	 * @inject
	 */
	public $translator;

	protected function startup()
	{
		parent::startup();
		$this->template->translator = $this->translator;
	}
}
