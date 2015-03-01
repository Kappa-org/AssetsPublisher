<?php
/**
 * This file is part of the Kappa\AssetsPublisher package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\AssetsPublisher\Utils;

class Arrays
{
	/**
	 * @param array $array
	 * @param $item
	 * @return bool|int|string
	 */
	public static function getKeyByValueInSubArray(array $array, $item)
	{
		foreach ($array as $key => $value) {
			if (in_array($item, $value)) {
				return $key;
			}
		}

		return false;
	}
}
