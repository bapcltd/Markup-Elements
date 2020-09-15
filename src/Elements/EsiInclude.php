<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template-extends AbstractElementFromAttributes<'esi:include', array{onerror:string, src:string}, array<empty, empty>>
 */
class EsiInclude extends AbstractElementFromAttributes
{
	public function ElementName() : string
	{
		return 'esi:include';
	}

	/**
	 * @return array{!element:'esi:include', !attributes:array{onerror:string, src:string}, !content:array<empty, empty>}
	 */
	public static function EsiInclude(
		string $src,
		string $onerror = 'continue'
	) : array {
		/**
		 * @var array{!element:'esi:include', !attributes:array{onerror:string, src:string}, !content:array<empty, empty>}
		 */
		$out = (new static())->FromAttributes(['onerror' => $onerror, 'src' => $src]);

		return $out;
	}
}
