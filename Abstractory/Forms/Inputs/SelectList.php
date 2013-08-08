<?php

/**
 * SelectList
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
class SelectList extends FormInput {

	protected $options;
	protected $selected;

	public function __construct($name, $attributes = array(), array $options = null) {
		parent::__construct($name, $attributes);
		$this->init();
		if (!is_null($options)) {
			$this->options = $options;
		}
	}

	protected function init() {
		$this->options = array();
		$this->selected = array();
	}

	public function setSelected(array $selected) {
		$this->selected = $selected;
	}

	public function getSelected() {
		return $this->selected;
	}

	public function select($option) {
		if (!$this->isSelected($option)) {
			$this->selected[] = $option;
		}
	}

	public function deselect($option) {
		if ($this->isSelected($option)) {
			$keys = array_keys($this->selected, $option);
			foreach ($keys as $key) {
				unset($this->selected[$key]);
			}
		}
	}

	public function isSelected($option) {
		return in_array($option, $this->selected);
	}

	public function setOptions(array $options) {
		$this->options = $options;
	}

    public function render() {
        $inputTpl = "<select name='%s' %s>";
        $inputTpl.= "\n\t%s";
        $inputTpl.= "\n</select>";

    	$tplData = array(
    		$this->name,
    		$this->renderAttributes(),
    		$this->renderOptions(),
        );
        return vsprintf($inputTpl, $tplData);
    }

    protected function renderOptions() {
    	$options = array();
    	$optionTpl = "<option value='%s' %s>%s</option>";
    	foreach ($this->options as $value => $label) {
	    	$tplData = array(
	    		$value,
	    		$this->isSelected($value) ? "selected='selected'" : '',
	    		$label,
    		);
    		$options[] = vsprintf($optionTpl, $tplData);
    	}
    	return implode("\n\t", $options);
    }
    
}
