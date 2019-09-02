<?php
/**
* @author SignpostMarv
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

use PHPUnit\Framework\TestCase as Base;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use RegexIterator;

class ElementsTest extends Base
{
	/**
	* @return array<int, array{0:class-string<AbstractElement>}>
	*/
	public function dataProviderElementClasses() : array
	{
		$directories = [
			__DIR__ . '/../src/Elements/',
			__DIR__ . '/../src/UtilityElements/',
		];

		$out = [];

		foreach ($directories as $directory_path_string) {
			$directory_path = realpath(
				$directory_path_string
			);

			$this->assertIsString($directory_path);
			$this->assertTrue(is_dir($directory_path));

			$directory = new RecursiveDirectoryIterator(
				$directory_path,
				(
					RecursiveDirectoryIterator::CURRENT_AS_PATHNAME |
					RecursiveDirectoryIterator::SKIP_DOTS |
					RecursiveDirectoryIterator::UNIX_PATHS
				)
			);

			$iterator = new RecursiveIteratorIterator($directory);

			/**
			* @var iterable<string>
			*/
			$filter = new RegexIterator($iterator, '/\.php$/');

			foreach ($filter as $filename) {
				/**
				* @var string
				*/
				$class_name =
					__NAMESPACE__ .
					'\\' .
					str_replace('/', '\\', mb_substr(
						$filename,
						mb_strlen($directory_path) + 1,
						-4
					));

				if (
					is_a(
						$class_name,
						AbstractElement::class,
						true
					) &&
					! (new ReflectionClass($class_name))->isAbstract()
				) {
					$out[] = [$class_name];
				}
			}
		}

		return $out;
	}

	/**
	* @return array<int, array{0:class-string<ElementInterface\FromAttributes\AndContent>}>
	*/
	public function dataProviderAbstractElementFromAttributesAndContent(
	) : array {
		/**
		* @var array<int, array{0:class-string<ElementInterface\FromAttributes\AndContent>}>
		*/
		return array_filter(
			$this->dataProviderElementClasses(),
			/**
			* @param array{
				0:class-string<AbstractElement>
			} $maybe
			*/
			function (array $maybe) : bool {
				return is_a(
					$maybe[0],
					ElementInterface\FromAttributes\AndContent::class,
					true
				);
			}
		);
	}

	/**
	* @return array<int, array{0:class-string<ElementInterface\FromAttributes>}>
	*/
	public function dataProviderAbstractElementFromAttributes(
	) : array {
		/**
		* @var array<int, array{0:class-string<ElementInterface\FromAttributes>}>
		*/
		return array_filter(
			$this->dataProviderElementClasses(),
			/**
			* @param array{
				0:class-string<AbstractElement>
			} $maybe
			*/
			function (array $maybe) : bool {
				return is_a(
					$maybe[0],
					ElementInterface\FromAttributes::class,
					true
				);
			}
		);
	}

	/**
	* @return array<int, array{0:class-string<ElementInterface\FromContent>}>
	*/
	public function dataProviderAbstractElementFromContent(
	) : array {
		/**
		* @var array<int, array{0:class-string<ElementInterface\FromContent>}>
		*/
		return array_filter(
			$this->dataProviderElementClasses(),
			/**
			* @param array{
				0:class-string<AbstractElement>
			} $maybe
			*/
			function (array $maybe) : bool {
				return is_a(
					$maybe[0],
					ElementInterface\FromContent::class,
					true
				);
			}
		);
	}

	/**
	* @dataProvider dataProviderAbstractElementFromAttributesAndContent
	*
	* @param class-string<ElementInterface\FromAttributes\AndContent> $class_name
	*/
	public function testElementNameFromAttributesAndContent(
		string $class_name
	) : void {
		$result = $class_name::FromAttributesAndContent([], []);

		$this->assertCount(3, $result);
		$this->assertArrayHasKey('!element', $result);

		/**
		* @var string
		*/
		$element_name = $class_name::ElementName();

		$this->assertSame($element_name, $result['!element']);
	}

	/**
	* @dataProvider dataProviderAbstractElementFromAttributes
	*
	* @param class-string<ElementInterface\FromAttributes> $class_name
	*/
	public function testElementNameFromAttributes(
		string $class_name
	) : void {
		$result = $class_name::FromAttributes([]);

		$this->assertCount(3, $result);
		$this->assertArrayHasKey('!element', $result);

		/**
		* @var string
		*/
		$element_name = $class_name::ElementName();

		$this->assertSame($element_name, $result['!element']);
	}

	/**
	* @dataProvider dataProviderAbstractElementFromContent
	*
	* @param class-string<ElementInterface\FromContent> $class_name
	*/
	public function testElementNameFromContent(
		string $class_name
	) : void {
		$result = $class_name::FromContent([]);

		$this->assertCount(3, $result);
		$this->assertArrayHasKey('!element', $result);

		/**
		* @var string
		*/
		$element_name = $class_name::ElementName();

		$this->assertSame($element_name, $result['!element']);
	}

	/**
	* @return array<int, array{0:class-string<AbstractElementFromAttributesAndContentCollection>}>
	*/
	public function dataProviderAbstractElementFromAttributesAndContentCollection(
	) : array {
		/**
		* @var array<int, array{0:class-string<AbstractElementFromAttributesAndContentCollection>}>
		*/
		return array_filter(
			$this->dataProviderElementClasses(),
			/**
			* @param array{
				0:class-string<AbstractElement>
			} $maybe
			*/
			function (array $maybe) : bool {
				return is_a(
					$maybe[0],
					AbstractElementFromAttributesAndContentCollection::class,
					true
				);
			}
		);
	}

	/**
	* @dataProvider dataProviderAbstractElementFromAttributesAndContentCollection
	*
	* @param class-string<AbstractElementFromAttributesAndContentCollection> $class_name
	*/
	public function testElementNameFromAttributesAndContentCollection(
		string $class_name
	) : void {
		$result = $class_name::FromAttributesAndContentCollection([], [[]]);

		$this->assertCount(3, $result);
		$this->assertArrayHasKey('!element', $result);

		/**
		* @var string
		*/
		$element_name = $class_name::ElementName();

		$this->assertSame($element_name, $result['!element']);
	}
}
