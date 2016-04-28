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
	 * @param string $directory the root directory of the package.
	 */
	public function __construct($directory)
	{
		$this->setDirectory($directory);
	}

	// }}}
	// {{{ public function setDirectory()

	/**
	 * @param string $directory
	 *
	 * @return Package
	 */
	public function setDirectory($directory)
	{
		$this->directory = (string)$directory;
		return $this;
	}

	// }}}
	// {{{ public function getDirectory()

	/**
	 * @return string
	 */
	public function getDirectory()
	{
		return $this->directory;
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
