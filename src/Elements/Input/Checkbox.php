<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

/**
* @template-extends AbstractInput<'checkbox'>
*/
class Checkbox extends AbstractInput
{
	public static function AbstractInputType() : string
	{
		return 'checkbox';
	}
}
