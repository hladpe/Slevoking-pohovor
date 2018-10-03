<?php

namespace App\Components\ClientInfo;

use App\Components\BaseComponent;
use Kdyby\Translation\Translator;
use UserAgentParser\Exception\NoResultFoundException;
use UserAgentParser\Provider\WhichBrowser;

/**
 * Class ClientInfo
 * @package App\Components\ClientInfo
 */
class ClientInfo extends BaseComponent
{
	/**
	 * @var array
	 */
	private $info = [];

	/**
	 * @var Translator
	 */
	private $translator;

	/**
	 * ClientInfo constructor.
	 * @param Translator $translator
	 */
	public function __construct(Translator $translator)
	{
		$this->translator = $translator;
		return parent::__construct();
	}

	/**
	 * @throws \UserAgentParser\Exception\PackageNotLoadedException
	 */
	protected function beforeRender(): void
	{
		$this->loadInfo();
		$this->template->info = $this->info;
	}

	/**
	 * @throws \UserAgentParser\Exception\PackageNotLoadedException
	 */
	public function render(): void
	{
		$this->beforeRender();
		$this->setLocalTemplateFile();
		$this->template->render();
	}

	/**
	 * @throws \UserAgentParser\Exception\PackageNotLoadedException
	 */
	private function loadInfo()
	{
		$this->info['ip'] = $_SERVER['REMOTE_ADDR'];
		$this->info['request_time'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		$trueTrans = $this->translator->translate('userinfo.states.true');
		$falseTrans = $this->translator->translate('userinfo.states.false');

		$provider = new WhichBrowser();
		try {
			$result = $provider->parse($_SERVER['HTTP_USER_AGENT']);
		} catch (NoResultFoundException $ex){
			return;
		}
		$this->info['is_bot'] = $result->isBot() ? $trueTrans : $falseTrans;

		if ($result->isBot() === true) {
			$this->info['bot_name'] = $result->getBot()->getName();
			$this->info['bot_type'] = $result->getBot()->getType();
		} else {
			$this->info['browser_name'] = $result->getBrowser()->getName();
			$this->info['browser_version'] = $result->getBrowser()->getVersion()->getComplete();

			$this->info['rendering_engine_name'] = $result->getRenderingEngine()->getName();
			$this->info['rendering_engine_version'] = $result->getRenderingEngine()->getVersion()->getComplete();

			$this->info['operation_system_name'] = $result->getOperatingSystem()->getName();
			$this->info['operation_system_version'] = $result->getOperatingSystem()->getVersion()->getComplete();

			$this->info['device_model'] = $result->getDevice()->getModel();
			$this->info['device_brand'] = $result->getDevice()->getBrand();
			$this->info['device_type'] = $result->getDevice()->getType();
			$this->info['device_is_mobile'] = $result->getDevice()->getIsMobile() ? $trueTrans : $falseTrans;
			$this->info['device_is_touchable'] = $result->getDevice()->getIsTouch() ? $trueTrans : $falseTrans;
		}
	}
}
