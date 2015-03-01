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

use Kappa\AssetsPublisher\Publisher;
use Nette\Utils\FileSystem;
use Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * Class PublisherTest
 *
 * @package Kappa\AssetsPublisher\Tests
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class PublisherTest extends TestCase
{
	const OUTPUT_NAME = 'hash';

	/** @var Publisher */
	private $publisher;

	protected function setUp()
	{
		$generatorMock = \Mockery::mock('Kappa\AssetsPublisher\Generators\HashGeneratorInterface');
		$generatorMock->shouldReceive('getHash')->once()->andReturn(self::OUTPUT_NAME);
		$this->publisher = new Publisher($generatorMock, TEMP_DIR);

		$outputFile = TEMP_DIR . DIRECTORY_SEPARATOR . self::OUTPUT_NAME . '.js';
		if (file_exists($outputFile)) {
			FileSystem::delete($outputFile);
		}
	}

	public function testMakePublish()
	{
		$outputFile = TEMP_DIR . DIRECTORY_SEPARATOR . self::OUTPUT_NAME . '.js';
		Assert::false(file_exists($outputFile));
		$source = DATA_DIR . '/file.js';
		$this->publisher->makePublish($source);
		Assert::true(file_exists($outputFile));
		Assert::same(file_get_contents($source), file_get_contents($outputFile));
	}

	protected function tearDown()
	{
		\Mockery::close();
	}}

\run(new PublisherTest());
