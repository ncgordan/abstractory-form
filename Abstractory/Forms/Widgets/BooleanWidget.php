<?php

/**
 * BooleanWidget
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
abstract class BooleanWidget {

    const TYPE_CHECKBOX = "CHECKBOX";
    const TYPE_DROPDOWN = "DROPDOWN";
    const TYPE_RADIO = "RADIO";

    const DEFAULT_TRUE = true;
    const DEFAULT_FALSE = false;

    protected $type;
    protected $default;
    protected $value;

    public function setDefault($boolean = self::DEFAULT_TRUE) {
        switch ($boolean) {
            case self::DEFAULT_TRUE:
            case self::DEFAULT_FALSE:
                $this->default = $boolean;
    	        break;
    	    default:
                $this->default = ($boolean) ? true : false;
    	        break;
        }
        return $this;
    }

    public function setValue($value) {
    	$this->value = $value;
    }

    public function getValue() {
    	return $this->value;
    }

}