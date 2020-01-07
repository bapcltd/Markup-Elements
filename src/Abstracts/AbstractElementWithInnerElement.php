<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ELEMENT as string
* @template ELEMENT_INNER as string
*
* @template-extends AbstractElement<ELEMENT>
*/
abstract class AbstractElementWithInnerElement extends AbstractElement
{
	/**
	* @return ELEMENT_INNER
	*/
	abstract protected function ElementNameInner() : string;
}
