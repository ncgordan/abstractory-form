<?php

namespace Abstractory\Forms\Components;

use Abstractory\Forms\Component;

/**
 * Label
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
class Label extends Component {

	/**
	 * The value of this label
	 *
	 * @var string
	 */
	protected $value;

	/**
	 * The id of the input element the label is associated with
	 *
	 * @var string
	 */
	protected $for;

	/**
	 * Non manadatory attributes associated with the element
	 *
	 * @var array
	 */
	protected $attributes;

	/**
	 * Return a new form input label
	 * 
	 * @param string $value The value of the label - HTML is supported
	 * @param string $for The id of the input element the label is associated with
	 * @param array $attributes An associative array mapping HTML attribute names to values for the label tag
	 */
	public function __construct($value, $for, array $attributes = null) {
		$this->value = $value;
		$this->for = $for;

		if ($attributes) {
			$this->attributes = $attributes;
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see Component::render()
	 */
	public function render() {
		$labelTpl = "<label for='%s' %s>%s</label>";
		$labelData = array(
				$this->for,
				$this->renderAttributes(),
				$this->value,
		);
		$label = vsprintf($labelTpl, $labelData);
		return $label;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setFor($id) {
		$this->for = $id;
	}


}

