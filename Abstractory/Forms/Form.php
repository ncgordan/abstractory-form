<?php

class Form extends FormComponent {

    const METHOD_POST = "POST";
    const METHOD_GET = "GET";

    const TARGET_SELF = '_self';
    const TARGET_BLANK = '_blank';
    const TARGET_PARENT = '_parent';
    const TARGET_TOP = '_top';

    const ENCTYPE_DEFAULT = 'application/x-www-form-urlencoded';
    const ENCTYPE_MULTIPART_FORM_DATA = 'multipart/form-data';
    const ENCTYPE_PLAIN_TEXT = 'text/plain';

    protected $attributes;

    protected $components;

    protected $method;
    protected $action;
    protected $enctype;
    protected $target;
    protected $name;

    public function __construct() {
        $this->init();
    }

    protected function init() {
        $this->attributes = array();
        $this->components = array();
    }

    public function setMethod($method) {
        switch (strtoupper($method)) {
            case self::METHOD_GET:
            case self::METHOD_POST:
                $this->method = strtoupper($method);
                break;
            default:
                throw new Exception("Method not supported");
                break;
        }
    }

    public function getMethod() {
        if (is_null($this->method)) {
            return self::METHOD_GET;
        }
        return $this->method;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function getAction() {
        return $this->action;
    }

    public function setEnctype($enctype) {
        switch (strtolower($enctype)) {
            case self::ENCTYPE_DEFAULT:
            case self::ENCTYPE_MULTIPART_FORM_DATA:
            case self::PLAIN_TEXT:
                $this->enctype = $enctype;
                break;
            default:
                throw new Exception("Encoding type not supported");
                break;
        }
    }

    public function getEnctype() {
        return $this->enctype;
    }

    public function add($index, FormComponent $component) {
	$this->components[$index] = $component;
    }

    public function remove($index) {
        if (array_key_exists($index, $this->components)) {
            unset($this->components[$index]);
        }
    }

    public function render() {
        $form = sprintf("<form %s>", $this->renderAttributes());
        $form.= $this->renderComponents();
        $form.= "</form>";
        return $form;
    }

    protected function renderAttributes() {
        $this->attributes['method'] = $this->getMethod();
        $this->attributes['action'] = $this->getAction();
        if (!is_null($this->getEnctype())) {
            $this->attributes['enctype'] = $this->getEnctype();
        }
        return parent::renderAttributes();
    }
    
    protected function renderComponents() {
        $renderedComponents = array();
        if (count($this->components)) {
            foreach ($this->components as $component) {
                $renderedComponents[] = $component->render();
            }
        }
        return "\n\t".implode("\n\t", $renderedComponents)."\n";
    }

}

