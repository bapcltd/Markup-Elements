<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Button;

/**
* @template-extends AbstractTypedButton<'button'>
*/
class Button extends AbstractTypedButton
{
	public function ButtonType() : string
	{
		return 'button';
	}
}
