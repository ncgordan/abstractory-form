<?php

/**
 * RadioButton
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
class RadioButton extends InputElement {

    public function check() {
        $this->attributes['checked'] = 'checked';
    }

    public function uncheck() {
        if ($this->isChecked()) {
            unset($this->attributes['checked']);
        }
    }

    public function isChecked() {
        return array_key_exists("checked", $this->attributes);
    }

    public function render() {
        $inputTpl = "<input type='radio' name='%s' %s />";
        $tplData = array(
            $this->name,
            $this->renderAttributes(),
        );
        return vsprintf($inputTpl, $tplData);
    }
    
    protected function getType() {
        "radio";
    }

}

