<?php
/**
 * This file is part of the Kappa\AssetsPublisher package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 *
 * @testCase
 */

namespace Kappa\AssetsPublisher\Tests;

use Kappa\AssetsPublisher\Utils\Arrays;
use Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class Arrays
 *
 * @package Kappa\AssetsPublisher\Tests
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class ArraysTest extends TestCase
{
	public function testGetKeyByValueInSubArray()
	{
		$array = [
			'bar' => ['one', 'two', 'foo'],
			'foo' => ['one', 'two']
		];
		Assert::same('bar', Arrays::getKeyByValueInSubArray($array, 'foo'));
	}
}

\run(new ArraysTest());
