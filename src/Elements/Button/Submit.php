<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Button;

/**
 * @template-extends AbstractTypedButton<'submit'>
 */
class Submit extends AbstractTypedButton
{
	public function ButtonType() : string
	{
		return 'submit';
	}
}
