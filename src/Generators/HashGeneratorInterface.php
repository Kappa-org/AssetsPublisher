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
 * Interface HashGeneratorInterface
 *
 * @package Kappa\AssetsPublisher\Generators
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
interface HashGeneratorInterface
{
	/**
	 * @param string $source
	 * @return string
	 */
	public function getHash($source);
}
