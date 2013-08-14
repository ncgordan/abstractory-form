<?php

/**
 * FormWidget
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
abstract class FormWidget {

    protected $name;

    public function __construct($name) {
    	$this->name = $name;
        $this->init();
    }

    abstract protected function init() {}

    public function assignProperties(array $properties) {
		foreach ($properties as $key => $value) {
			if (property_exists($this, $key)) {
				$this->$key = $value;
			}
		}
    	return $this;
    }

    abstract public function render();

}