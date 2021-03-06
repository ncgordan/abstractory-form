<?php

namespace Abstractory\Forms\Components\Inputs;

/**
 * Checkbox
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
class Checkbox extends InputElement {

	public function check() {
		$this->attributes['checked'] = 'checked';
	}

	public function uncheck() {
		if ($this->isChecked()) {
			unset($this->attributes['checked']);
		}
	}

	public function isChecked() {
		return array_key_exists("checked", $this->attributes);
	}

	protected function getType() {
		return "checkbox";
	}

}

