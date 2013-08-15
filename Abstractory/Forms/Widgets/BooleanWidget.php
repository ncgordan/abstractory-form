<?php

namespace Forms\Widgets;

use Abstractory\Forms\ComponentCollection;

/**
 *
 * @author suhmayah
 *        
 */
abstract class BooleanWidget extends ComponentCollection {
	
    const TYPE_CHECKBOX = "CHECKBOX";
    const TYPE_DROPDOWN = "DROPDOWN";
    const TYPE_RADIO = "RADIO";

    const DEFAULT_TRUE = true;
    const DEFAULT_FALSE = false;

    protected $type;
    protected $default;
    protected $value;
	
    /**
     * 
     */
	function __construct($name, $type = self::TYPE_CHECKBOX) {
		parent::__construct($name);
		$this->setType($type);
	}
	
	public function setType($type) {
		switch ($type) {
			case self::TYPE_CHECKBOX:
			case self::TYPE_DROPDOWN:
			case self::TYPE_RADIO:
				$this->type = $type;
				break;
			default:
				throw new \Exception("Type not supported: $type");
				break;
		}
		return $this;
	}
	
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
		return $this;
	}
	
	public function getValue() {
		return $this->value;
	}
	
}

