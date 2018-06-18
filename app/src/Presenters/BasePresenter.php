<?php declare(strict_types=1);

namespace App\Presenters;

use App\Components\FlashComponent;
use App\Components\IFlashFactory;
use ProLib\Metadata\IMetadata;
use ProLib\Metadata\IMetadataComponent;
use Thunbolt\Application\Presenter;

abstract class BasePresenter extends Presenter {

	/** @var IMetadata @inject */
	public $metadata;

	/** @var IMetadataComponent */
	private $metadataComponent;

	/** @var IFlashFactory */
	private $flashFactory;

	protected function beforeRender() {
		parent::beforeRender();

		if ($this->isAjax()) {
			$this['flashes']->redrawFlashes();
		}
	}

	public function injectBasePresenter(IMetadataComponent $metadataComponent, IFlashFactory $flashFactory) {
		$this->metadataComponent = $metadataComponent;
		$this->flashFactory = $flashFactory;
	}

	protected function createComponentFlashes(): FlashComponent {
		$control = $this->flashFactory->create();
		$flashes = [];
		if ($this->hasFlashSession()) {
			$id = $this->getParameterId('flash');
			$flashes = (array) $this->getFlashSession()->$id;
		}

		$control->setFlashes($flashes);

		return $control;
	}

	protected function createComponentMetadata(): IMetadataComponent {
		return $this->metadataComponent;
	}

}
