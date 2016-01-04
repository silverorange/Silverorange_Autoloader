<?php

/* vim: set noexpandtab tabstop=4 shiftwidth=4 foldmethod=marker: */

use Silverorange\Autoloader;

/**
 * Automatically requires PHP files for undefined classes
 *
 * This static class is responsible for resolving filenames from class names
 * of undefined classes. The PHP 5 spl_autoload function is used to load files
 * based on rules defined in this static class.
 *
 * To add a new autoloader rule, use the {@link Autoloader::addRule()} method.
 *
 * @package   Silverorange_Autoloader
 * @copyright 2006-2016 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @see       Rule
 */
class Autoloader
{
	// {{{ private properties

	/**
	 * @var arary
	 */
	private static $rules = array();

	// }}}
	// {{{ public static function addRule()

	/**
	 * Adds an autoloader rule to the autoloader
	 *
	 * @param Rule $rule the autoloader rule to add.
	 *
	 * @return void
	 */
	public static function addRule(Rule $rule)
	{
		self::$rules[] = $rule;
	}

	// }}}
	// {{{ public static function removeRule()

	/**
	 * Removes an autoloader rule from the autoloader
	 *
	 * @param Rule $rule the autoloader rule to remove.
	 *
	 * @return void
	 */
	public static function removeRule(Rule $rule)
	{
		self::$rules = array_diff(self::$rules, array($rule));
	}

	// }}}
	// {{{ public static function getFileFromClass()

	/**
	 * Gets the filename of a class name
	 *
	 * This method uses the autoloader's list of rules to find an appropriate
	 * filename for a class name. This is used by PHP 5's __autoload() method
	 * to find an appropriate file for undefined classes.
	 *
	 * @param string $class_name the name of the class to get the filename for.
	 *
	 * @return string the name of the file that likely contains the class
	 *                 definition or null if no such filename could be
	 *                 determined.
	 */
	public static function getFileFromClass($class_name)
	{
		$filename = null;

		foreach (self::$rules as $rule) {
			$result = $rule->apply($class_name);
			if ($result !== null) {
				$filename = $result;
				break;
			}
		}

		return $filename;
	}

	// }}}
	// {{{ public static function autoload()

	/**
	 * Provides an opportunity to define a class before causing a fatal error
	 * when an undefined class is used
	 *
	 * If an appropriate file exists for the given class name, it is required.
	 *
	 * @param string $class_name the name of the undefined class.
	 *
	 * @return void
	 */
	public static function autoload($class_name)
	{
		$filename = self::getFileFromClass($class_name);

		// We do not throw an exception here because is_callable() will break.

		if ($filename !== null) {
			require $filename;
		}
	}

	// }}}
	// {{{ public static function register()

	/**
	 * Registers {@link Autoloader::autoload()} as an autoload function with
	 * the spl_autoload function
	 *
	 * See {@link http://ca.php.net/manual/en/function.spl-autoload-register.php
	 * the documentation on SPL autoloading} for details.
	 *
	 * @return void
	 */
	public static function register()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	// }}}
}

?>
