<?php

namespace Abstractory\Forms\Components\Inputs;
/**
 * FileInput
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
class FileInput extends InputElement {

	protected $maxFileSize;

	protected function getType() {
		return "file";
	}

	public function setMaxFileSize($bytes) {
		$this->maxFileSize = $bytes;
	}

}

