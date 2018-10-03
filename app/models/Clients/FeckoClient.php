<?php

namespace App\Models\Clients;

use App\Models\Collections\FeckoCollection;
use App\Models\Interfaces\IClient;
use Nette\Utils\Json;

/**
 * Class FeckoClient
 * @package App\Models\Client
 */
class FeckoClient implements IClient
{
	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var FeckoCollection|null
	 */
	private $data;

	/**
	 * FeckoClient constructor.
	 * @param string $url
	 */
	public function __construct(string $url)
	{
		$this->url = $url;
	}

	/**
	 * @return FeckoCollection|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	public function load()
	{
		if (empty($this->data)) {
			$this->download();
		}
		return $this->data;
	}

	/**
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \Nette\Utils\JsonException
	 */
	private function download()
	{
		$client = new \GuzzleHttp\Client();
		$response = $client->request('GET', $this->url);
		$data = Json::decode(
			$response->getBody()
		);
		$this->data = new FeckoCollection($data);
	}
}
