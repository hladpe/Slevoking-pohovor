<?php

namespace App\Components\ClientInfo;

/**
 * Interface IClientInfoFactory
 * @package App\Components\ClientInfo
 */
interface IClientInfoFactory
{
	/**
	 * @return ClientInfo
	 */
	public function create();
}
