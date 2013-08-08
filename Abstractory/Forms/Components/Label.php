<?php

/**
 * Label
 *
 * @author Suhmayah Banda <suhmayah.banda@digitallifesciences.co.uk>
 */
class Label extends FormComponent {

    /**
     * The value of this label
     * 
     * @var string
     */
    protected $value;
    
    /**
     * The id of the input element the label is associated with
     * 
     * @var string 
     */
    protected $for;
    
    /**
     * Non manadatory attributes associated with the element
     * 
     * @var array
     */
    protected $attributes;
    
    public function __construct($value, $for, $attributes = null) {
        $this->value = $value;
        $this->for = $for;
        
        if ($attributes) {
            $this->attributes = $attributes;
        }
    }
    
    public function render() {
        $labelTpl = "<label for='%s' %s>%s</label>";
        $labelData = array(
            $this->for,
            $this->renderAttributes(),
            $this->value,
        );
        $label = vsprintf($labelTpl, $labelData);
        return $label;
    }
    

}

