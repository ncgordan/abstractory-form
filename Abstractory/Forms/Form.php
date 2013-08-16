<?php

namespace Abstractory\Forms;

/**
 * Form
 *
 * @author Suhmayah Banda <su@aboynamedsu.net>
 */
class Form extends ComponentCollection {

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

	/**
	 * Set the request method for form submission - Form::METHOD_GET or Form::METHOD_POST
	 * 
	 * @param string $method
	 * @throws Exception
	 */
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
		return $this;
	}

	/**
	 * Returns the form request method - defaults to Form::METHOD_GET
	 * 
	 * @return string
	 */
	public function getMethod() {
		if (is_null($this->method)) {
			return self::METHOD_GET;
		}
		return $this->method;
	}

	/**
	 * Set the form action - the URL to which the form data should be submitted
	 * 
	 * @param string $action
	 */
	public function setAction($action) {
		$this->action = $action;
		return $this;
	}

	/**
	 * Returns the form action
	 * 
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * Set the form enctype - use Form::ENCTYPE_* constants - ENCTYPE_DEFAULT, ENCTYPE_MULTIPART_FORM_DATA, PLAIN_TEXT
	 * 
	 * @param string $enctype
	 * @throws Exception
	 */
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
		return $this;
	}

	/**
	 * Returns the form enctype
	 * 
	 * @return mixed string or null if not set
	 */
	public function getEnctype() {
		return $this->enctype;
	}

	/**
	 * (non-PHPdoc)
	 * @see FormComponent::render()
	 */
	public function render() {
		$form = sprintf("<form %s>\n\t", $this->renderAttributes());
		$formComponents = array();
		foreach ($this->components as $component) {
			$formComponents[] = "<div class='af__row'>\n\t".$component->render()."\n\t</div>";
		}
		$form.= implode("\n\n\t", $formComponents);
		$form.= "\n</form>\n";
		return $form;
	}

	/**
	 * (non-PHPdoc)
	 * @see FormComponent::renderAttributes()
	 */
	protected function renderAttributes() {
		$this->attributes['method'] = $this->getMethod();
		$this->attributes['action'] = $this->getAction();
		if (!is_null($this->getEnctype())) {
			$this->attributes['enctype'] = $this->getEnctype();
		}
		return parent::renderAttributes();
	}
	
}

