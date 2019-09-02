<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type TRCONTENTS = array{!element:'th'|'td', !content:array<int, scalar|array{!element:string}>}
* @psalm-type TRCOLLECTION = array<int, array{!element:'tr', !content:array<int, TRCONTENTS>}>
*
* @template T0 as 'thead'|'tbody'|'tfoot'
* @template T1 as array<string, scalar|array<int, scalar>>
*
* @template-extends AbstractElementFromAttributesAndContent<T0, T1, array<int, array{!element:'tr', !content:array<int, array{!element:'td'|'th', !content:array<int, scalar|array{!element:string}>}>}>>
*/
abstract class AbstractRequiresTableRows extends AbstractElementFromAttributesAndContent
{
	/**
	* @param array<int, array<int, TRCONTENTS>> $collection
	*
	* @return array{!element:T0, !content:TRCOLLECTION}
	*/
	public static function FromContentCollection(array $collection) : array
	{
		/**
		* @var TRCOLLECTION
		*/
		$rows = array_map(
			/**
			* @param array<int, TRCONTENTS> $row_content
			*
			* @return array{!element:'tr', !content:array<int, TRCONTENTS>}
			*/
			function (array $row_content) : array {
				return TableRow::FromAttributesAndContent([], $row_content);
			},
			$collection
		);

		/**
		* @var array{!element:T0, !content:TRCOLLECTION}
		*/
		$out = static::FromAttributesAndContent([], $rows);

		return $out;
	}
}
