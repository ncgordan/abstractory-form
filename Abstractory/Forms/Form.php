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
	 * Adds a FormComponent to the form referenced by $index
	 * 
	 * This will overwrite any existing component referenced by the same index
	 * 
	 * @param string $index
	 * @param FormComponent $component
	 */
	public function add($index, FormComponent $component) {        
        if ($this->hasComponent($index)) {
            throw new Exception("Component already exists: $index");
        }

		$this->components[$index] = $component;
		return $this;
	}

	/**
	 * Removes a form component referenced by $index
	 *  
	 * @param string $index
	 */
	public function remove($index) {
		if (array_key_exists($index, $this->components)) {
			unset($this->components[$index]);
		}
		return $this;
	}

    protected function assertComponentCanBeAdded($componentName, $index) {
        if (!$this->hasComponent($componentName)) {
            throw new Exception("Component not found in form: $componentName");
        }

        if ($this->hasComponent($index)) {
            throw new Exception("Component already exists: $index");
        }
        return true;
    }

    /**
     * Adds a form component, $component, referenced by $index before the existing component $componentName
     *  
     * @param string $componentName The component before which to add the new component
     * @param string $index The form reference of the component to add
     * @param FormComponent $component The component to add
     */
    public function insertBefore($componentName, $index, FormComponent $component) {
        $this->assertComponentCanBeAdded($componentName, $index);
        $tmpComponents = array();
        $originalIndex = 0;
        foreach ($this->components as $key => $formComponent) {
            if ($key === $componentName) {
                $tmpComponents[$index] = $component;
                break;
            }
            $tmpComponents[$key] = $formComponent;
            $originalIndex++;
        }
        $slice = array_slice($this->components, $originalIndex, null, true);
        $this->components = array_merge($tmpComponents, $slice);
        return $this;
    }

    /**
     * Adds a form component, $component, referenced by $index after the existing component $componentName
     *  
     * @param string $componentName The component after which to add the new component
     * @param string $index The form reference of the component to add
     * @param FormComponent $component The component to add
     */
    public function insertAfter($componentName, $index, FormComponent $component) {
        $this->assertComponentCanBeAdded($componentName, $index);
        $tmpComponents = array();
        $originalIndex = 0;
        foreach ($this->components as $key => $formComponent) {
            $tmpComponents[$key] = $formComponent;
            $originalIndex++;
            if ($key === $componentName) {
                $tmpComponents[$index] = $component;
                break;
            }
        }
        $slice = array_slice($this->components, $originalIndex, null, true);
        $this->components = array_merge($tmpComponents, $slice);
        return $this;
    }

    /**
     * Determine whether or not a component has been added to the form
     * 
     * @param string $index The components identifier within the form
     * @return boolean True if the component has been added, false if it hasn't been
     */
    public function hasComponent($index) {
        return array_key_exists($index, $this->components);
    }
	
	/**
	 * Returns the form component referenced by $index
	 * 
	 * @param string $index
	 * @return mixed FormComponent or false
	 */
	public function getComponent($index) {
		if ($this->hasComponent($index)) {
			return $this->components[$index];
		}
		return false;
	}

	/**
	 * (non-PHPdoc)
	 * @see FormComponent::render()
	 */
	public function render() {
		$form = sprintf("<form %s>", $this->renderAttributes());
		$form.= $this->renderComponents();
		$form.= "</form>";
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

	/**
	 * 
	 * @return string
	 */
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

