<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

/**
* @template-extends AbstractInput<'text'>
*/
class Text extends AbstractInput
{
	public function AbstractInputType() : string
	{
		return 'text';
	}
}
