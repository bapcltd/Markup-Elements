<?php
/**
* @author SignpostMarv
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

use DateTimeImmutable;
use ParagonIE\ConstantTime\Base64UrlSafe;
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
			0:class-string<Input\Time>|class-string<Input\Date>,
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
	* @param class-string<Input\Time>|class-string<Input\Date> $class_name
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
				'!attributes' => [
					'name' => 'foo',
				],
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
					'name' => 'foo',
					'value' => [1, 3],
				],
				[
					Input\Select\Option::FromAttributes(['value' => 0]),
					Input\Select\Optgroup::FromAttributesAndContent(
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

	public function testStaticPictureSingleLocalWithCacheBust() : void
	{
		$this->assertSame(
			[
				[
					'!element' => 'picture',
					'!attributes' => [
						'data-picture' => Base64UrlSafe::encode(hash_file(
							'sha384',
							__DIR__ . '/Fixtures/foo.webp',
							true
						)),
					],
					'!content' => [
						[
							'!element' => 'img',
							'!attributes' => [
								'width' => 1,
								'height' => 1,
								'src' => 'https://example.com/foo.93ee6a8fd0.webp',
							],
						],
					],
				],
				[
					'!element' => 'style',
					'!attributes' => [
						'integrity' => 'sha256-LWqdy2k1m8AGLI7nkYtP3/757l+MysSjn5t9CRctPuY=',
					],
					'!content' => [
						'picture[data-picture="k-5qj9AetabfClAktY-kbPstTwhgit5P2NsFjnNlDY6iDLhrfAqjExpKbaVkaOKH"]{max-width:1rem;}',
					],
				],
			],
			StaticPicture::ToMarkupCollection(
				'https://example.com/',
				__DIR__ . '/Fixtures/',
				true,
				1,
				1,
				[],
				[],
				'/foo.webp'
			)
		);
	}

	public function testStaticPictureMultipleLocalNoCacheBust() : void
	{
		$this->assertSame(
			[
				[
					'!element' => 'picture',
					'!attributes' => [
						'data-picture' => Base64UrlSafe::encode(hash_file(
							'sha384',
							__DIR__ . '/Fixtures/foo.jpg',
							true
						)),
					],
					'!content' => [
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/webp',
								'srcset' => 'https://example.com/foo.webp',
							],
						],
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/png',
								'srcset' => 'https://example.com/foo.png',
							],
						],
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/jpeg',
								'srcset' => 'https://example.com/foo.jpg',
							],
						],
						[
							'!element' => 'img',
							'!attributes' => [
								'width' => 1,
								'height' => 1,
								'src' => 'https://example.com/foo.jpg',
							],
						],
					],
				],
				[
					'!element' => 'style',
					'!attributes' => [
						'integrity' => 'sha256-2RVrnOg604QxvYhhAnrnI7vhxP7JhEighII4FMt/BVc=',
					],
					'!content' => [
						'picture[data-picture="eTh6y1CpWSNSTG2ejOfB22SUOkrpEWmHpKfqgLns6I9s6ghmFkQffh4l2yGLSp_A"]{max-width:1rem;}',
					],
				],
			],
			StaticPicture::ToMarkupCollection(
				'https://example.com/',
				__DIR__ . '/Fixtures/',
				false,
				1,
				1,
				[],
				[],
				'/foo.webp',
				'/foo.png',
				'/foo.jpg'
			)
		);
	}

	public function testStaticPictureMultipleRemoteNoCacheBust() : void
	{
		$this->assertSame(
			[
				[
					'!element' => 'picture',
					'!attributes' => [
						'data-picture' => 'N2I2NTY0ZmZlYTZhNzMyNzRjZjJkYzhhZTYyZGQ1YzNlMGViN2YwZWRhMzAyYWI2NDc5OWJmYzg2NmJmYTE3MDVmMDRkOTkwYTIxNGVkMDBkMGRhZjQ5ZDFlYzQ1NWE4',
					],
					'!content' => [
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/webp',
								'srcset' => 'https://example.com/foo.webp',
							],
						],
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/png',
								'srcset' => 'https://example.com/foo.png',
							],
						],
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/gif',
								'srcset' => 'https://example.com/foo.gif',
							],
						],
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/svg+xml',
								'srcset' => 'https://example.com/foo.svg',
							],
						],
						[
							'!element' => 'source',
							'!attributes' => [
								'type' => 'image/jpeg',
								'srcset' => 'https://example.com/foo.jpg',
							],
						],
						[
							'!element' => 'img',
							'!attributes' => [
								'width' => 1,
								'height' => 1,
								'src' => 'https://example.com/foo.jpg',
							],
						],
					],
				],
				[
					'!element' => 'style',
					'!attributes' => [
						'integrity' => 'sha256-nGz8vfxGAnMBYcw2UZc+H1HYAQpbRfzX1qArNYbAnrI=',
					],
					'!content' => [
						'picture[data-picture="N2I2NTY0ZmZlYTZhNzMyNzRjZjJkYzhhZTYyZGQ1YzNlMGViN2YwZWRhMzAyYWI2NDc5OWJmYzg2NmJmYTE3MDVmMDRkOTkwYTIxNGVkMDBkMGRhZjQ5ZDFlYzQ1NWE4"]{max-width:1rem;}',
					],
				],
			],
			StaticPicture::ToMarkupCollection(
				'https://example.com/',
				__DIR__ . '/Fixtures/',
				false,
				1,
				1,
				[],
				[],
				'https://example.com/foo.webp',
				'https://example.com/foo.png',
				'https://example.com/foo.gif',
				'https://example.com/foo.svg',
				'https://example.com/foo.jpg'
			)
		);
	}

	public function testStaticPictureExpectPossibleInlineSvg() : void
	{
		$this->assertSame(
			[
				[
					'!element' => 'picture',
					'!attributes' => [
						'data-picture' => 'MjE4NDQwMTFhZTlkOWQwYmQ4ZGY2MTljMWI1NmYwYmFhNmExZjdmZjg1Mjc3YTdiNDhiZmRkZGFhMjllOGU3Njg4ZWI1MWE2NTJlYjNkY2ZmM2NkOGExOTUyNjMzOWRj',
					],
					'!content' => [
						[
							'!element' => 'img',
							'!attributes' => [
								'width' => 1,
								'height' => 1,
								'src' => 'https://static-cdn.bapc.ltd/@mdi/svg/3.8.95/svg/format-quote-open.svg',
							],
						],
					],
				],
				[
					'!element' => 'style',
					'!attributes' => [
						'integrity' => 'sha256-TwJW3Ecm5P19DY9g7y3RvoHJaGgZzvfnwNJ7iR54AWs=',
					],
					'!content' => [
						'picture[data-picture="MjE4NDQwMTFhZTlkOWQwYmQ4ZGY2MTljMWI1NmYwYmFhNmExZjdmZjg1Mjc3YTdiNDhiZmRkZGFhMjllOGU3Njg4ZWI1MWE2NTJlYjNkY2ZmM2NkOGExOTUyNjMzOWRj"],svg[data-picture="MjE4NDQwMTFhZTlkOWQwYmQ4ZGY2MTljMWI1NmYwYmFhNmExZjdmZjg1Mjc3YTdiNDhiZmRkZGFhMjllOGU3Njg4ZWI1MWE2NTJlYjNkY2ZmM2NkOGExOTUyNjMzOWRj"]{max-width:1rem;}',
					],
				],
			],
			StaticPicture::ToMarkupCollection(
				'https://example.com/',
				__DIR__ . '/Fixtures/',
				false,
				1,
				1,
				[],
				[],
				'https://static-cdn.bapc.ltd/@mdi/svg/3.8.95/svg/format-quote-open.svg'
			)
		);
	}
}
