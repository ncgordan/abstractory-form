<?php

namespace Widgets\Booleans;

use Abstractory\Forms\Components\Label;
use Abstractory\Forms\ComponentCollection;
use Abstractory\Forms\Components\ContentBlock;
/**
 *
 * @author suhmayah
 *        
 */
class Checkbox extends ComponentCollection {
	
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
		return $this;
	}
	
	protected function initCheckbox($id) {
		$this->checkbox = new \Abstractory\Forms\Components\Inputs\Checkbox($this->name, array('id' => $id));
		return $this;
	}
	
	protected function compile() {
		$widget = new ContentBlock($this->name."CheckboxBoolean");
		$content = sprintf("<span id='%s'>\n\t\t%s\n\t\t%s\n\t</span>", $this->name, $this->label->render(), $this->checkbox->render());
		$widget->setContent($content);
		$this->add($this->name, $widget);
		return $this;
	}
	
	public function render() {
		return $this->compile()->renderComponents();
	}
	
}
