<?php

namespace App\Presenters;

use App\Components\ClientInfo\IClientInfoFactory;
use App\Models\Clients\FeckoClient;
use Nette\Application\UI\Form;
use DateTime;
use DateInterval;
use DatePeriod;

/**
 * Class HomepagePresenter
 * @package App\Presenters
 */
class HomepagePresenter extends BasePresenter
{
	/**
	 * @var IClientInfoFactory
	 * @inject
	 */
	public $clientInfoFactory;

	/**
	 * @var FeckoClient
	 * @inject
	 */
	public $feckoClient;

	/**
	 * @var \App\Models\Collections\FeckoCollection|null
	 */
	private $items;

	/**
	 * @var \App\Models\Collections\FeckoCollection|null
	 */
	private $filteredItems;

	/**
	 * @var int|null
	 */
	private $processedTask;

	/**
	 * @return void
	 */
	protected function beforeRender()
	{
		$this->template->processedTask = $this->processedTask;
		$this->template->filteredItems = $this->filteredItems;

		$filteredItemsCount = count($this->filteredItems);
		$this->template->filteredItemsCount = $filteredItemsCount;
		$this->template->unfilteredItemsCount = count($this->items) - $filteredItemsCount;
	}

	/**
	 * @return \App\Models\Collections\FeckoCollection
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	private function getItems()
	{
		if (!$this->items) {
			$this->loadItems();
		}
		return $this->items;
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	private function loadItems()
	{
		$this->items = $this->feckoClient->load();
	}

	/**
	 * @return Form
	 */
	protected function createComponentTasksForm()
	{
		$form = new Form;
		$form->getElementPrototype()->class('ajax');
		$form->addSubmit('processTask1', $this->translator->translate('homepage.form.processTask1'))
			->onClick[] = [$this, 'processTask1'];
		$form->addSubmit('processTask2', $this->translator->translate('homepage.form.processTask2'))
			->onClick[] = [$this, 'processTask2'];
		$form->addSubmit('processTask3', $this->translator->translate('homepage.form.processTask3'))
			->onClick[] = [$this, 'processTask3'];
		$form->addSubmit('processTask4', $this->translator->translate('homepage.form.processTask4'))
			->onClick[] = [$this, 'processTask4'];
		return $form;
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	public function processTask1()
	{
		$this->filteredItems = $this->getItems()
			->filterByReverseName([
				'laravel',
				'envoyer'
			]);
		$this->processedTask = 1;
		$this->redrawControl('details');
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	public function processTask2()
	{
		$items = $this->getItems();
		$filter = function () {
			if ($this->getSecond() === 0) {
				return false;
			}

			if ($this->getFirst() / $this->getSecond() !== $this->getThird()) {
				return false;
			}

			$devidable4 = $this->getThird() % 4 === 0;
			$devidable5 = $this->getThird() % 5 === 0;
			$devidable6 = $this->getThird() % 6 === 0;

			return $devidable4 && ($devidable5 || $devidable6);
		};

		$this->filteredItems = $items->filterByCallback($filter);
		$this->processedTask = 2;
		$this->redrawControl('details');
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	public function processTask3()
	{
		$items = $this->getItems();

		$begin = new DateTime( '2014-01-02 21:00:30' );
		$end = new DateTime( '2014-12-31' );
		$interval = new DateInterval('P1M');
		$dateperiod = new DatePeriod($begin, $interval ,$end);

		$this->filteredItems = $items->filterByCreatedPeriod($dateperiod);
		$this->processedTask = 3;
		$this->redrawControl('details');
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	public function processTask4()
	{
		$this->filteredItems = $this->getItems()
			->filterByCorrectMathCalculation();
		$this->processedTask = 4;
		$this->redrawControl('details');
	}

	/**
	 * @return \App\Components\ClientInfo\ClientInfo
	 */
	protected function createComponentClientInfo()
	{
		return $this->clientInfoFactory->create();
	}
}