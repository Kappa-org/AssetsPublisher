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

use Kappa\AssetsPublisher\Generators\HashGenerator;
use Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class HashGeneratorTest
 *
 * @package Kappa\AssetsPublisher\Tests
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class HashGeneratorTest extends TestCase
{
	/** @var HashGenerator */
	private $hashGenerator;

	protected function setUp()
	{
		$this->hashGenerator = new HashGenerator();
	}

	public function testGetHash()
	{
		Assert::match('~[a-z0-9]+~', $this->hashGenerator->getHash(__FILE__));
	}
}

\run(new HashGeneratorTest());
