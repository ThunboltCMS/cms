<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use WebChemistry\Parameters\IEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="parameters")
 */
class Parameter implements IEntity {

	/** @var bool */
	public static $strict = TRUE;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=50)
	 */
	protected $id;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $content;

	/**
	 * @ORM\Column(type="boolean", options={"default"="0"})
	 */
	protected $isSerialized = FALSE;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return self
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	public function setContent($content) {
		if ($this->isSerialized) {
			if (!is_array($content)) {
				if (self::$strict === TRUE) {
					throw new \Exception(sprintf('Parameters %s must be array, %s given.', $this->id, gettype($this->content)));
				} else {
					return NULL;
				}
			} else {
				$this->content = serialize($content);
			}
		} else {
			$this->content = $content;
		}

		return $this;
	}

	/**
	 * @return array|string
	 */
	public function getContent() {
		if ($this->isSerialized) {
			return unserialize($this->content);
		}

		return $this->content;
	}

	/**
	 * @param bool $serialized
	 * @return self
	 */
	public function setIsSerialized($serialized) {
		$this->isSerialized = $serialized;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function getIsSerialized() {
		return $this->isSerialized;
	}

	/**
	 * @return bool
	 */
	public function isSerialized() {
		return $this->isSerialized;
	}

}
