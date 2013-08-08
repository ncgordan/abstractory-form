<?php

/**
 * InputElement
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
abstract class InputElement extends FormInput {

    public function render() {
        $inputTpl = "<input type='%s' name='%s' %s />";
        $tplData = array(
            $this->getType(),
            $this->name,
            $this->renderAttributes(),
        );
        return vsprintf($inputTpl, $tplData);
    }
    
    abstract protected function getType();

}

