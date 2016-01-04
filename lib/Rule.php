<?php

/* vim: set noexpandtab tabstop=4 shiftwidth=4 foldmethod=marker: */

namespace Silverorange\Autoloader;

/**
 * A class autoloader rule
 *
 * Class autoloader rules define how class names map to filenames. An
 * autoloader rule consists of a starting prefix, a set of optional ending
 * prefixes, and an optional subdirectory.
 *
 * If a class name matches a rule, the filename is built as:
 *
 *  <start-prefix>/<directory>/<class_name>.php
 *
 * @package   Silverorange_Autoloader
 * @copyright 2006-2016 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @see       Autoloader
 */
class Rule
{
	// {{{ protected properties

	/**
	 * @var string
	 */
	protected $directory = '';

	/**
	 * @var string
	 */
	protected $starts_with = '';

	/**
	 * @var integer
	 */
	protected $start_length = 0;

	/**
	 * @var array
	 */
	protected $ends_with = array();

	// }}}
	// {{{ public function __construct()

	/**
	 * Creates a new class autoloader rule
	 *
	 * @param string       $directory   the subdirectory to use for matched
	 *                                  classes. Pass an empty string to not
	 *                                  use a subdirectory.
	 * @param string       $starts_with the class name prefix this rule matches on.
	 * @param string|array $ends_with   optional. The class name suffixes this
	 *                                  rule matches on. If not specified, no
	 *                                  suffix matching is performed.
	 */
	public function __construct($directory, $starts_with, $ends_with = null)
	{
		$this->setDirectory($directory);
		$this->setStartsWith($starts_with);
		$this->setEndsWith($ends_with);
	}

	// }}}
	// {{{ public function setDirectory()

	/**
	 * @param string $directory
	 *
	 * @return Rule
	 */
	public function setDirectory($directory)
	{
		$this->directory = (string)$directory;

		return $this;
	}

	// }}}
	// {{{ public function setStartsWith()

	/**
	 * @param string $starts_with
	 *
	 * @return Rule
	 */
	public function setStartsWith($starts_with)
	{
		$this->starts_with = (string)$starts_with;
		$this->start_length = strlen($starts_with);

		return $this;
	}

	// }}}
	// {{{ public function setEndsWith()

	/**
	 * @param array|string $ends_with optional.
	 *
	 * @return Rule
	 */
	public function setEndsWith($ends_with = null)
	{
		if ($ends_with === null) {
			$this->ends_with = array();
		} elseif (!is_array($ends_with))  {
			$this->ends_with = array(
				(string)$ends_with => strlen($ends_with)
			);
		} else {
			foreach ($ends_with as $value) {
				$value = (string)$value;
				$this->ends_with[$value] = strlen($value);
			}
		}

		return $this;
	}

	// }}}
	// {{{ public function matches()

	/**
	 * Checks if this rule applies to a class name
	 *
	 * @param string $class_name the name of the class to check.
	 *
	 * @return boolean true if this rule matches the class name, otherwise
	 *                 false.
	 */
	public function matches($class_name)
	{
		// simple prefix match
		$matches = (strncmp(
			$this->starts_with,
			$class_name,
			$this->start_length
		) === 0);

		// also check suffixes if specified
		if ($matches && count($this->ends_with) > 0) {
			$matches = false;
			foreach ($this->ends_with as $ends_with => $length) {
				$matches = (
					strlen($class_name) >= $length &&
					substr($class_name, -$length) == $ends_with
				);
				if ($matches) {
					break;
				}
			}
		}

		return $matches;
	}

	// }}}
	// {{{ public function apply()

	/**
	 * Applies this autoloader rule to a class name
	 *
	 * @param string $class_name the name of the class to apply this rule to.
	 *
	 * @return string the filename the class name maps to if the filename
	 *                matches this rule, or null if the filename does not
	 *                match this rule.
	 */
	public function apply($class_name)
	{
		$filename = null;

		if ($this->matches($class_name)) {
			$filename = $this->starts_with . '/';

			if ($this->directory != '') {
				$filename .= $this->directory . '/';
			}

			$filename .= $class_name . '.php';
		}

		return $filename;
	}

	// }}}
}

?>
