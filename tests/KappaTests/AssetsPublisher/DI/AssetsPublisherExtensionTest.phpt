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

use Nette\Configurator;
use Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class AssetsPublisherExtensionTest
 *
 * @package Kappa\AssetsPublisher\Tests
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class AssetsPublisherExtensionTest extends TestCase
{
	public function testHashGenerator()
	{
		$type = 'Kappa\AssetsPublisher\Generators\HashGenerator';
		Assert::type($type, $this->getContainer()->getByType($type));
	}

	public function testPublisher()
	{
		$type = 'Kappa\AssetsPublisher\Publisher';
		Assert::type($type, $this->getContainer()->getByType($type));
	}

	/**
	 * @return \Nette\DI\Container
	 */
	protected function getContainer()
	{
		$configurator = new Configurator();
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . '/../../../data/config.neon');

		return $configurator->createContainer();
	}
}

\run(new AssetsPublisherExtensionTest());
