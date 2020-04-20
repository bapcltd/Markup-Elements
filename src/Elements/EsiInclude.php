<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type SRC = string
 * @psalm-type ONERROR = string
 *
 * @template-extends AbstractElementFromAttributes<'esi:include', array{onerror:ONERROR, src:SRC}, array<empty, empty>>
 */
class EsiInclude extends AbstractElementFromAttributes
{
	public function ElementName() : string
	{
		return 'esi:include';
	}

	/**
	 * @param SRC $src
	 * @param ONERROR $onerror
	 *
	 * @return array{!element:'esi:include', !attributes:array{onerror:ONERROR, src:SRC}, !content:array<empty, empty>}
	 */
	public static function EsiInclude(
		string $src,
		string $onerror = 'continue'
	) : array {
		/**
		 * @var array{!element:'esi:include', !attributes:array{onerror:ONERROR, src:SRC}, !content:array<empty, empty>}
		 */
		$out = (new static())->FromAttributes(['onerror' => $onerror, 'src' => $src]);

		return $out;
	}
}
