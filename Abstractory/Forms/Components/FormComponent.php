<?php

/**
 * FormComponent
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
abstract class FormComponent {

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

    public function setAttributes(array $attributes) {
        $this->attributes = $attributes;
    }

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

}

