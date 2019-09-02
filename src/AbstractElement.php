<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ELEMENT as string
*/
abstract class AbstractElement
{
	/**
	* @return ELEMENT
	*/
	abstract public static function ElementName() : string;
}
