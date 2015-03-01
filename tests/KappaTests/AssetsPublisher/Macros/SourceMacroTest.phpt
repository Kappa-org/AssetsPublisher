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

use Kappa\AssetsPublisher\Macros\SourceMacro;
use Tester\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Class SourceMacroTest
 *
 * @package Kappa\AssetsPublisher\Tests
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class SourceMacroTest extends TestCase
{
	/** @var SourceMacro */
	private $sourceMacro;

	protected function setUp()
	{
		$macroSetMock = \Mockery::mock('Latte\Compiler');
		$this->sourceMacro = new SourceMacro($macroSetMock);
	}

	/**
	 * @param string $tagName
	 * @param string $expectedAttr
	 * @dataProvider provideMacroSource
	 */
	public function testMacroSource($tagName, $expectedAttr)
	{
		$expected = " $expectedAttr=\"<?php echo \$_presenter->getContext()->getByType('Kappa\AssetsPublisher\Publisher')->makePublish(%node.word); ?>\"";
		Assert::same($expected, $this->sourceMacro->macroSource($this->getMacroNodeMock($tagName), $this->getPhpWriter()));
	}

	/**
	 * @return array
	 */
	public function provideMacroSource()
	{
		return [
			['audio', 'src'],
			['embed', 'src'],
			['iframe', 'src'],
			['img', 'src'],
			['input', 'src'],
			['script', 'src'],
			['source', 'src'],
			['track', 'src'],
			['audio', 'src'],

			['a', 'href'],
			['area', 'href'],
			['link', 'href'],
			['base', 'href'],
		];
	}

	protected function tearDown()
	{
		\Mockery::close();
	}

	/**
	 * @return \Mockery\MockInterface
	 */
	private function getMacroNodeMock($tagName)
	{
		$htmlNode = \Mockery::mock('Latte\HtmlNode');
		$htmlNode->name = $tagName;
		$macroNode = \Mockery::mock('Latte\MacroNode');
		$macroNode->htmlNode = $htmlNode;

		return $macroNode;
	}

	/**
	 * @return \Mockery\MockInterface
	 */
	private function getPhpWriter()
	{
		$phpWriter = \Mockery::mock('Latte\PhpWriter');
		$phpWriter->shouldReceive('write')->andReturnUsing(function ($args) {
			$result = '<?php' . $args . '?>';
			$result = preg_replace('~<\?php\s*\?>~', '', $result);

			return $result;
		});

		return $phpWriter;
	}
}

\run(new SourceMacroTest());
