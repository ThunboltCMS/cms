<?php declare(strict_types = 1);

namespace App;

use Nette\Configurator;
use Thunbolt\Bootstrap;

final class Booting {

	/** @var string */
	private const CONFIG = __DIR__ . '/config/config.neon';

	/** @var bool */
	private $environmentConfig = true;

	/** @var bool|string|array|null */
	private $debugMode;

	/** @var string */
	private $maintenanceFile;

	/** @var bool */
	private $maintenance = false;

	/**
	 * @param string $maintenanceFile
	 * @param bool|string|array|null $debugMode
	 */
	public function __construct(string $maintenanceFile, $debugMode = null) {
		$this->debugMode = $debugMode;
		$this->maintenanceFile = $maintenanceFile;
	}

	public function setMaintenance(bool $maintenance) {
		$this->maintenance = $maintenance;

		return $this;
	}

	public function setEnvironmentConfig(bool $environmentConfig = true) {
		$this->environmentConfig = $environmentConfig;

		return $this;
	}

	public function checkMaintenance() {
		if (!Configurator::detectDebugMode($this->debugMode)) {
			require $this->maintenanceFile;

			exit;
		}
	}

	public function boot(): Configurator {
		$configurator = new Configurator();
		if ($this->maintenance) {
			$this->checkMaintenance();
		}
		if ($this->debugMode !== null) {
			$configurator->setDebugMode($this->debugMode);
		}

		$configurator->addParameters([
			'appVarDir' => __DIR__ . '/var',
			'varDir' => realpath(__DIR__ . '/../var'),
			'rootDir' => realpath(__DIR__ . '/..'),
		]);

		$bootstrap = new Bootstrap(__DIR__, $configurator);
		$bootstrap->initialize();

		$configurator->addConfig(self::CONFIG);

		$devEnv = false;
		if ($this->environmentConfig) {
			$devEnv = (bool) getenv('NETTE_DEV');
			$configurator->addConfig(
				__DIR__ . '/config/environment/' . ($devEnv ? 'development.neon' : 'production.neon')
			);
		}
		$configurator->addParameters([
			'debugEnv' => $devEnv,
		]);

		return $configurator;
	}

}
