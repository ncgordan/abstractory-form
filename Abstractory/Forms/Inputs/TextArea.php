<?php

/**
 * TextArea
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
class TextArea extends FormInput {

	protected $value;

	/**
	 * 
	 * @param string $name The name of the textarea element
	 * @param array $attributes An associative array mapping attribute names to their values
	 * @param string $value The content of the textarea
	 */
	public function __construct($name, array $attributes = array(), $value = null) {
		parent::__construct($name, $attributes);
		if (!is_null($value)) {
			$this->value = $value;
		}
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function getValue() {
		return $this->value;
	}

	/**
	 * (non-PHPdoc)
	 * @see FormComponent::render()
	 */
	public function render() {
		$inputTpl = "<textarea name='%s' %s>%s</textarea>";
		$tplData = array(
				$this->name,
				$this->renderAttributes(),
				$this->getValue(),
		);
	}

}

