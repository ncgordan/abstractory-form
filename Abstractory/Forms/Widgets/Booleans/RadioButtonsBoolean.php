<?php

namespace Forms\Widgets\Booleans;

use Abstractory\Forms\ComponentCollection;
use Abstractory\Forms\Components\Label;
use Abstractory\Forms\Components\Inputs\RadioButton;
use Abstractory\Forms\Components\ContentBlock;

/**
 *
 * @author suhmayah
 *        
 */
class RadioButtonsBoolean extends ComponentCollection {
	
	/**
	 * 
	 * @var Label
	 */
	public $choice;
	
	/**
	 * 
	 * @var Label
	 */
	public $trueLabel;
	
	/**
	 * 
	 * @var Label
	 */
	public $falseLabel;
	
	/**
	 * 
	 * @var RadioButton
	 */
	public $trueBtn;
	
	/**
	 * 
	 * @var RadioButton
	 */
	public $falseBtn;
	
	protected function init() {
		parent::init();
		$this->initChoice()
		     ->initTrueBtn()
		     ->initFalseBtn();
	}
	
	protected function initChoice() {
		$this->choice = new Label("True or False?", "trueSwitch", array('id' => $this->name.'Choice'));
		$this->add("choice", $this->choice);
		return $this;
	}
	
	protected function initTrueBtn() {
		$trueBtnId = $this->name."TrueBtn";
		
		$this->trueLabel = new Label("True Label", $trueBtnId, array('id' => "trueLabel"));
		
		$this->trueBtn = new RadioButton($this->name, array('id' => $trueBtnId));
		$this->trueBtn->setValue('true');

		$trueSwitch = new ContentBlock("trueSwitch");
		$content = sprintf("<span id='trueSwitch'>\n\t\t{$this->trueLabel}\n\t\t{$this->trueBtn}\n\t</span>");
		$trueSwitch->setContent($content);
		$this->add("trueSwitch", $trueSwitch);
		return $this;
	}
	
	protected function initFalseBtn() {
		$falseBtnId = $this->name."FalseBtn";
		
		$this->falseLabel = new Label("False Label", $falseBtnId, array( 'id' => "falseLabel"));
		
		$this->falseBtn = new RadioButton($this->name, array('id' => $falseBtnId));
		$this->falseBtn->setValue('false');
		
		$falseSwitch = new ContentBlock("falseSwitch");
		$content = sprintf("<span id='falseSwitch'>\n\t\t{$this->falseLabel}\n\t\t{$this->falseBtn}\n\t</span>");
		$falseSwitch->setContent($content);
		$this->add("falseSwitch", $falseSwitch);
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \Abstractory\Forms\Component::render()
	 *
	 */
	public function render() {
		return $this->renderComponents();
	}
}

?>