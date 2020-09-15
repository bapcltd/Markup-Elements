<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

use function array_map;

/**
 * @psalm-type TRCONTENTS = array{!element:'th'|'td', !content:list<scalar|array{!element:string}>}
 * @psalm-type TRCOLLECTION = list<array{!element:'tr', !content:list<TRCONTENTS>}>
 *
 * @template ELEMENT as 'thead'|'tbody'|'tfoot'
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 *
 * @template-extends AbstractElementFromAttributesAndContent<ELEMENT, ATTRIBUTES, list<array{!element:'tr', !content:list<array{!element:'td'|'th', !content:list<scalar|array{!element:string}>}>}>>
 */
abstract class AbstractRequiresTableRows extends AbstractElementFromAttributesAndContent
{
	/**
	 * @param list<list<TRCONTENTS>> $collection
	 *
	 * @return array{!element:ELEMENT, !content:TRCOLLECTION}
	 */
	public function FromContentCollection(array $collection) : array
	{
		/**
		 * @var TRCOLLECTION
		 */
		$rows = array_map(
			/**
			 * @param list<TRCONTENTS> $row_content
			 *
			 * @return array{!element:'tr', !content:list<TRCONTENTS>}
			 */
			static function (array $row_content) : array {
				return (new TableRow())->FromAttributesAndContent([], $row_content);
			},
			$collection
		);

		/**
		 * @var array{!element:ELEMENT, !content:TRCOLLECTION}
		 */
		$out = (new static())->FromContent($rows);

		return $out;
	}
}
