<?php

namespace Abstractory\Forms\Components\Inputs;

use Abstractory\Forms\Components\Input;
/**
 * InputElement
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
abstract class InputElement extends Input{

	public function render() {
		$inputTpl = "<input type='%s' name='%s' %s />";
		$tplData = array(
				$this->getType(),
				$this->name,
				$this->renderAttributes(),
		);
		return vsprintf($inputTpl, $tplData);
	}
	
	public function setValue($value) {
		$this->setAttribute('value', $value);
	}
	
	abstract protected function getType();

}

