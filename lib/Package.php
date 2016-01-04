<?php

/* vim: set noexpandtab tabstop=4 shiftwidth=4 foldmethod=marker: */

namespace Silverorange\Autoloader;

/**
 * Autoloader package
 *
 * @package   Silverorange_Autoloader
 * @copyright 2006-2016 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @see       Autoloader
 * @see       Rule
 */
class Package
{
	// {{{ protected properties

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var array
	 */
	protected $rules = array();

	// }}}
	// {{{ public function __construct()

	/**
	 * Creates a new autoloader package
	 *
	 * @param string $name the name of the package. Use the composer package
	 *                     name.
	 */
	public function __construct($name)
	{
		$this->setName($name);
	}

	// }}}
	// {{{ public function setName()

	/**
	 * @param string $name
	 *
	 * @return Package
	 */
	public function setName($name)
	{
		$this->name = (string)$name;
		return $this;
	}

	// }}}
	// {{{ public function getName()

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	// }}}
	// {{{ public function addRule()

	/**
	 * Adds an autoloader rule to this package
	 *
	 * @param Rule $rule the autoloader rule to add.
	 *
	 * @return Package
	 */
	public function addRule(Rule $rule)
	{
		$this->rules[] = $rule;
		return $this;
	}

	// }}}
	// {{{ public function removeRule()

	/**
	 * Removes an autoloader rule from this package
	 *
	 * @param Rule $rule the autoloader rule to remove.
	 *
	 * @return Package
	 */
	public static function removeRule(Rule $rule)
	{
		$this->rules = array_diff($this->rules, array($rule));
	}

	// }}}
	// {{{ public function getRules()

	/**
	 * @return array
	 */
	public function getRules()
	{
		return $this->rules;
	}

	// }}}
}

?>
