<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template ELEMENT as string
 */
interface ElementInterface
{
	/**
	 * @return ELEMENT
	 */
	public function ElementName() : string;
}
