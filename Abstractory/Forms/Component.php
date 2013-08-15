<?php

namespace Abstractory\Forms;

/**
 * Component
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
abstract class Component {

	abstract public function render();

	protected function renderAttributes() {
		$attributes = array();
		if (is_array($this->attributes) && count($this->attributes)) {
			foreach ($this->attributes as $key => $value) {
				$attributes[] = $this->renderAttribute($key, $value);
			}
		}
		return implode(" ", $attributes);
	}

	protected function renderAttribute($key, $value) {
		if (is_array($value)) {
			$v = implode(" ", $value);
		} else {
			$v = $value;
		}
		return "$key='$v'";
	}

	/**
	 * Sets the HTML attributes for the form component
	 * 
	 * @param array $attributes An associative array mapping attribute names to their values
	 */
	public function setAttributes(array $attributes) {
		$this->attributes = $attributes;
	}

	/**
	 * Set a HTML attribute for the form component 
	 * 
	 * @param string $key The attribute name
	 * @param string $value The attribute value
	 */
	public function setAttribute($key, $value) {
		$this->attributes[$key] = $value;
	}
	
	public function setId($id) {
		$this->setAttribute("id", $id);
	}

}

