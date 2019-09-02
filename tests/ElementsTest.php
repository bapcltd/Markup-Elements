<?php
/**
* @author SignpostMarv
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

use DateTimeImmutable;
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

	public function testEsi() : void
	{
		$this->assertSame(
			[
				'!element' => 'esi:include',
				'!attributes' => [
					'onerror' => 'continue',
					'src' => 'foo',
				],
				'!content' => [],
			],
			EsiInclude::EsiInclude('foo')
		);
	}

	/**
	* @return array<
		int,
		array{
			0:class-name<Input\Time>|class-name<Input\Date>,
			1:array
		}
	>
	*/
	public function dataProviderInputSupportsDateTimeInterface() : array
	{
		return [
			[
				Input\Time::class,
				[
					'!element' => 'input',
					'!attributes' => [
						'value' => '03:04:05',
						'type' => 'time',
					],
					'!content' => [],
				],
			],
			[
				Input\Date::class,
				[
					'!element' => 'input',
					'!attributes' => [
						'value' => '1970-01-02',
						'type' => 'date',
					],
					'!content' => [],
				],
			],
		];
	}

	/**
	* @dataProvider dataProviderInputSupportsDateTimeInterface
	*
	* @param class-name<Input\Time>|class-name<Input\Date> $class_name
	*/
	public function testInputSupportsDateTimeInterface(
		string $class_name,
		array $expected
	) : void {
		$this->assertSame(
			$expected,
			$class_name::FromAttributes([
				'value' => new DateTimeImmutable('1970-01-02 03:04:05'),
			])
		);
	}

	public function testInputTextArea() : void
	{
		$this->assertSame(
			[
				'!element' => 'textarea',
				'!attributes' => [],
				'!content' => ['foo'],
			],
			Input\TextArea::FromAttributes(['value' => 'foo'])
		);
	}

	public function testSelect() : void
	{
		$this->assertSame(
			[
				'!element' => 'select',
				'!attributes' => [],
				'!content' => [
					[
						'!element' => 'option',
						'!attributes' => [
							'value' => 0,
							'selected' => false,
						],
						'!content' => [],
					],
					[
						'!element' => 'optgroup',
						'!attributes' => [
							'label' => 'bar',
						],
						'!content' => [
							[
								'!element' => 'option',
								'!attributes' => [
									'value' => 1,
									'selected' => true,
								],
								'!content' => [],
							],
							[
								'!element' => 'option',
								'!attributes' => [
									'value' => 2,
									'selected' => false,
								],
								'!content' => [],
							],
						],
					],
					[
						'!element' => 'option',
						'!attributes' => [
							'value' => 1,
							'selected' => true,
						],
						'!content' => [],
					],
					[
						'!element' => 'option',
						'!attributes' => [
							'value' => 3,
							'selected' => true,
						],
						'!content' => [],
					],
				],
			],
			Input\Select::FromAttributesAndContent(
				[
					'value' => [1, 3],
				],
				[
					Input\Select\Option::FromAttributes(['value' => 0]),
					Input\Select\OptGroup::FromAttributesAndContent(
						['label' => 'bar'],
						[
							Input\Select\Option::FromAttributes(['value' => 1]),
							Input\Select\Option::FromAttributes(['value' => 2]),
						]
					),
					Input\Select\Option::FromAttributes(['value' => 1]),
					Input\Select\Option::FromAttributes(['value' => 3]),
				]
			)
		);
	}

	/**
	* @return array<int, array{0:class-string<AbstractRequiresTableRows>}>
	*/
	public function dataProviderRequiresTableRows() : array
	{
		return [
			[
				TableHeader::class,
			],
			[
				TableBody::class,
			],
			[
				TableFooter::class,
			],
		];
	}

	/**
	* @dataProvider dataProviderRequiresTableRows
	*
	* @param class-string<AbstractRequiresTableRows> $class_name
	*/
	public function testRequiresTableRows(string $class_name) : void
	{
		$this->assertSame(
			[
				'!element' => $class_name::ElementName(),
				'!attributes' => [],
				'!content' => [
					[
						'!element' => 'tr',
						'!attributes' => [],
						'!content' => [
							[
								'!element' => 'td',
								'!attributes' => [],
								'!content' => [],
							],
						],
					],
				],
			],
			$class_name::FromContentCollection([
				[
					TableCell::FromAttributes([]),
				],
			])
		);
	}
}
