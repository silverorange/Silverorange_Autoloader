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
 *  <start-prefix>/<directory>/<class-name>.php
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
	protected $startsWith = '';

	/**
	 * @var integer
	 */
	protected $startLength = 0;

	/**
	 * @var array
	 */
	protected $endsWith = array();

	// }}}
	// {{{ public function __construct()

	/**
	 * Creates a new class autoloader rule
	 *
	 * @param string       $directory  the subdirectory to use for matched
	 *                                 classes. Pass an empty string to not
	 *                                 use a subdirectory.
	 * @param string       $startsWith the class name prefix this rule matches
	 *                                 on.
	 * @param string|array $endsWith   optional. The class name suffixes this
	 *                                 rule matches on. If not specified, no
	 *                                 suffix matching is performed.
	 */
	public function __construct($directory, $startsWith, $endsWith = null)
	{
		$this->setDirectory($directory);
		$this->setStartsWith($startsWith);
		$this->setEndsWith($endsWith);
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
	 * @param string $startsWith
	 *
	 * @return Rule
	 */
	public function setStartsWith($startsWith)
	{
		$this->startsWith = (string)$startsWith;
		$this->startLength = strlen($startsWith);

		return $this;
	}

	// }}}
	// {{{ public function setEndsWith()

	/**
	 * @param array|string $endsWith optional.
	 *
	 * @return Rule
	 */
	public function setEndsWith($endsWith = null)
	{
		if ($endsWith === null) {
			$this->endsWith = array();
		} elseif (!is_array($endsWith))  {
			$this->endsWith = array(
				(string)$endsWith => strlen($endsWith)
			);
		} else {
			foreach ($endsWith as $value) {
				$value = (string)$value;
				$this->endsWith[$value] = strlen($value);
			}
		}

		return $this;
	}

	// }}}
	// {{{ public function matches()

	/**
	 * Checks if this rule applies to a class name
	 *
	 * @param string $className the name of the class to check.
	 *
	 * @return boolean true if this rule matches the class name, otherwise
	 *                 false.
	 */
	public function matches($className)
	{
		// simple prefix match
		$matches = (strncmp(
			$this->startsWith,
			$className,
			$this->startLength
		) === 0);

		// also check suffixes if specified
		if ($matches && count($this->endsWith) > 0) {
			$matches = false;
			foreach ($this->endsWith as $endsWith => $length) {
				$matches = (
					strlen($className) >= $length &&
					substr($className, -$length) == $endsWith
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
	 * @param string $className the name of the class to apply this rule to.
	 *
	 * @return string the filename the class name maps to if the filename
	 *                matches this rule, or null if the filename does not
	 *                match this rule.
	 */
	public function apply($className)
	{
		$filename = null;

		if ($this->matches($className)) {
			$filename = $this->startsWith . DIRECTORY_SEPARATOR;

			if ($this->directory != '') {
				$filename .= $this->directory . DIRECTORY_SEPARATOR;
			}

			$filename .= $className . '.php';
		}

		return $filename;
	}

	// }}}
}

?>
