<?php

/**
 * TextArea
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
class TextArea extends FormInput {

	protected $value;

	public function __construct($name, $attributes = array(), $value = null) {
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

    public function render() {
    	$inputTpl = "<textarea name='%s' %s>%s</textarea>";
    	$tplData = array(
    		$this->name,
    		$this->renderAttributes(),
    		$this->getValue(),
		);
    }
    
}

