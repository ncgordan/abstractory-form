<?php

namespace Abstractory\Forms\Components\Inputs;

/**
 * InputElement
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
abstract class InputElement extends \Abstractory\Forms\Components\Input {

	public function render() {
		$inputTpl = "<input type='%s' name='%s' %s />";
		$tplData = array(
				$this->getType(),
				$this->name,
				$this->renderAttributes(),
		);
		return vsprintf($inputTpl, $tplData);
	}

	abstract protected function getType();

}

