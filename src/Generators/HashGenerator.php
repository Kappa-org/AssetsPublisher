<?php
/**
 * This file is part of the Kappa\AssetsPublisher package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\AssetsPublisher\Generators;

/**
 * Class HashGenerator
 *
 * @package Kappa\AssetsPublisher\Generators
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class HashGenerator implements HashGeneratorInterface
{
	/**
	 * @param string $source
	 * @return string
	 */
	public function getHash($source)
	{
		$info = new \SplFileInfo($source);

		return md5($info->getPathname() . $info->getSize() . $info->getMTime());
	}
}
