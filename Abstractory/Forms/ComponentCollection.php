<?php

namespace Abstractory\Forms;

/**
 *
 * @author suhmayah
 *        
 */
abstract class ComponentCollection extends Component {
	
	/**
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * 
	 * @var array
	 */
	protected $components;
	
	public function __construct($name) {
		$this->name = $name;
		$this->init();
	}
	
	protected function init() {
		$this->components = array();
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
	
	/**
	 * Adds a FormComponent to the form referenced by $index
	 *
	 * This will overwrite any existing component referenced by the same index
	 *
	 * @param string $index
	 * @param FormComponent $component
	 */
	public function add($index, Component $component) {
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
	public function insertBefore($componentName, $index, Component $component) {
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
	public function insertAfter($componentName, $index, Component $component) {
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
	
}

