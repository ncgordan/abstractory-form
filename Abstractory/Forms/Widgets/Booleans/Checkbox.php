<?php

namespace Widgets\Booleans;

use Forms\Widgets\BooleanWidget;
use Abstractory\Forms\Components\Label;
/**
 *
 * @author suhmayah
 *        
 */
class Checkbox extends BooleanWidget {
	
	/**
	 * 
	 * @var Label
	 */
	public $label;
	
	/**
	 * 
	 * @var Checkbox
	 */
	public $checkbox;
	
	protected function init() {
		parent::init();
		
		$labelValue = ucwords($this->name." Label");
		$labelId = $this->name."Label";
		$checkboxId = $this->name."Checkbox";
		
		$this->initLabel($labelValue, $checkboxId, $labelId)
		     ->initCheckbox($checkboxId);
	}
	
	protected function initLabel($value, $for, $id) {
		$this->label = new Label($value, $for, array('id' => $id));
		$this->add("label", $this->label);
		return $this;
	}
	
	protected function initCheckbox($id) {
		$this->checkbox = new \Abstractory\Forms\Components\Inputs\Checkbox($this->name, array('id' => $id));
		$this->add("checkbox", $this->checkbox);
		return $this;
	}
	
	public function render() {
		return $this->renderComponents();
	}
	
}
