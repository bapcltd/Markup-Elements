<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Button;

/**
* @template-extends AbstractTypedButton<'reset'>
*/
class Reset extends AbstractTypedButton
{
	public static function ButtonType() : string
	{
		return 'reset';
	}
}
