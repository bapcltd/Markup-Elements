<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

use ParagonIE\ConstantTime\Base64UrlSafe;

class StaticPicture
{
	/**
	 * @param list<string> $sources
	 * @param numeric $width
	 * @param numeric $height
	 *
	 * @return array{0:array{!element:'picture'}, 1:array{!element:'style'}}
	 */
	public static function ToMarkupCollection(
		string $static_base_url,
		string $dir,
		bool $cache_bust_urls,
		$width,
		$height,
		array $picture_attributes,
		array $img_attributes,
		string $source,
		string ...$sources
	) : array {
		$img_attributes['width'] = $width;
		$img_attributes['height'] = $height;

		array_unshift($sources, $source);

		$sources = array_filter($sources, static function (string $maybe) : bool {
			return 1 === preg_match('/\.(?:jpe?g|png|gif|svgz?|webp)$/i', $maybe);
		});

		$as_files = array_filter(
			$sources,
			static function (string $in) use ($static_base_url, $dir) : bool {
				$expected = realpath($dir . $in);

				return
					is_string($expected) &&
					is_file($expected) &&
					0 === mb_strpos($expected, realpath($dir));
			}
		);

		$as_urls = array_filter(
			$sources,
			static function (string $in) : bool {
				return 1 === preg_match('/^https:\/\//', $in);
			}
		);

		if (count($as_files) > 0) {
			$hash = hash_file(
				'sha384',
				(string) realpath($dir . $as_files[(int) array_key_last($as_files)]),
				true
			);
		} else {
			$hash_pointer = hash_init('sha384');
			foreach ($sources as $source) {
				hash_update($hash_pointer, $source . "\n");
			}

			hash_update($hash_pointer, 'width: ' . $width . "\n");

			$hash = hash_final($hash_pointer);
		}

		/**
		 * @var string
		 */
		$selector = $picture_attributes['data-picture'] ?? Base64UrlSafe::encode($hash);

		$picture_attributes['data-picture'] = $selector;

		/**
		 * @var array<string, string>
		 */
		$content = array_combine(
			array_map(
				static function (string $in) use ($static_base_url, $cache_bust_urls, $dir) : string {
					if (1 === preg_match('/^\.?\//', $in)) {
						if ( ! $cache_bust_urls) {
							return
								$static_base_url .
								preg_replace('/^\.?\//', '', $in);
						}

						$expected = realpath($dir . $in);

						if (
							is_string($expected) &&
							is_file($expected) &&
							0 === mb_strpos($expected, realpath($dir))
						) {
							$hash = mb_substr(
								bin2hex(hash_file('sha384', $expected, true)),
								0,
								10
							);

							return $static_base_url . preg_replace(
								'/^\.?\/(.+)\.(jpe?g|png|gif|svgz?|webp)$/i',
								('$1.' . rawurlencode($hash) . '.$2'),
								$in
							);
						}
					}

					return $in;
				},
				$sources
			),
			array_map(
				static function (string $in) : string {
					preg_match('/\.(jpe?g|png|gif|svgz?|webp)$/i', $in, $matches);

					switch (mb_strtolower($matches[1])) {
						case 'jpg':
						case 'jpeg':
							return 'image/jpeg';
						case 'png':
							return 'image/png';
						case 'gif':
							return 'image/gif';
						case 'svg':
						case 'svgz':
							return 'image/svg+xml';
					}

					return 'image/webp';
				},
				$sources
			)
		);

		/**
		 * @var string
		 */
		$default_src = array_key_last($content);

		$out = [];

		if (count($content) > 1) {
			foreach ($content as $url => $type) {
				$out[] = [
					'!element' => 'source',
					'!attributes' => [
						'type' => $type,
						'srcset' => $url,
					],
				];
			}
		}

		$selectors = [
			(
				'picture[data-picture="' .
				$selector .
				'"]'
			),
		];

		if (
			0 === count($out) &&
			preg_match(
				'/^https:\/\/static\-cdn\.bapc\.ltd\/.+\.svg$/',
				$default_src
			)
		) {
			$selectors[] = (
				'svg[data-picture="' .
				$selector .
				'"]'
			);
		}

		$style_content = implode('', [
			implode(',', $selectors) .
			'{',
			sprintf('max-width:%urem;', $width),
			'}',
		]);

		$out[] = [
			'!element' => 'img',
			'!attributes' => array_merge($img_attributes, [
				'src' => $default_src,
			]),
		];
		$out = [
			[
				'!element' => 'picture',
				'!attributes' => $picture_attributes,
				'!content' => $out,
			],
			[
				'!element' => 'style',
				'!attributes' => [
					'integrity' => (
						'sha256-' .
						base64_encode(hash('sha256', $style_content, true))
					),
				],
				'!content' => [$style_content],
			],
		];

		/**
		 * @var array{0:array{!element:'picture'}, 1:array{!element:'style'}}
		 */
		return $out;
	}
}
