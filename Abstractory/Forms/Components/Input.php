<?php

namespace Abstractory\Forms\Components;

/**
 * Input
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
abstract class Input extends Component {

	/**
	 * The field name of the input element
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Non mandatory attributes for the input element
	 *
	 * @var array
	 */
	protected $attributes;

	/**
	 * Returns a new input element
	 * 
	 * @param string $name The name of the input element
	 * @param array $attributes An associative array mapping element attribute names to values
	 */
	public function __construct($name, array $attributes = null) {
		$this->init();

		$this->name = $name;
		if (!is_null($attributes)) {
			$this->attributes = $attributes;
		}
	}

	private function init() {
		$this->attributes = array();
	}

}

