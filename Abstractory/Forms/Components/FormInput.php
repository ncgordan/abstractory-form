<?php

/**
 * FormElement
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
abstract class FormInput extends FormComponent {

    /**
     * The field name of the input element
     *
     * @var string
     */
    protected $name;

    /**
     * Non mandatory attributes for the input element
     *
     * @var array
     */
    protected $attributes;

    public function __construct($name, array $attributes = null) {
        $this->init();

        $this->name = $name;
        if (!is_null($attributes)) {
            $this->attributes = $attributes;
        }
    }

    private function init() {
        $this->attributes = array();
    }
    
}

