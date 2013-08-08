<?php

/**
 * ContentBlock
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
class ContentBlock extends FormComponent {

    protected $html;

    public function __construct($html = null) {
        if (!is_null($html)) {
            $this->html = $html;
        }
    }

    public function setContent($html) {
        $this->html = $content
    }
    
    public function render() {
        return $this->html;
    }

}
