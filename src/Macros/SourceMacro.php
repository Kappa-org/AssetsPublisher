<?php
/**
 * This file is part of the Kappa\AssetsPublisher package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\AssetsPublisher\Macros;

use Kappa\AssetsPublisher\UnsupportedTagNameException;
use Kappa\AssetsPublisher\Utils\Arrays;
use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;

/**
 * Class SrcMacro
 *
 * @package Kappa\AssetsPublisher\Macros
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class SourceMacro extends MacroSet
{
	/**
	 * @param Compiler $compiler
	 */
	public static function install(Compiler $compiler)
	{
		$set = new static($compiler);
		$set->addMacro('source', NULL, NULL, array($set, 'macroSource'));
	}

	/**
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 */
	public function macroSource(MacroNode $node, PhpWriter $writer)
	{
		return $writer->write('?> ' . $this->getAttribute($node) . '="<?php echo ' . $this->getPublisherCode() . '; ?>"<?php');
	}

	/**
	 * @param MacroNode $node
	 * @return bool|int|string
	 */
	private function getAttribute(MacroNode $node)
	{
		$types = [
			'src' => ['audio', 'embed', 'iframe', 'img', 'input', 'script', 'source', 'track', 'video'],
			'href' => ['a', 'area', 'link', 'base']
		];
		$tagName = $node->htmlNode->name;
		$attr = Arrays::getKeyByValueInSubArray($types, $tagName);
		if (!$attr) {
			throw new UnsupportedTagNameException("Tag '{$tagName}' is not supported.");
		}

		return $attr;
	}

	/**
	 * @return string
	 */
	private function getPublisherCode()
	{
		$service = 'Kappa\AssetsPublisher\Publisher';

		return "\$_presenter->getContext()->getByType('{$service}')->makePublish(%node.word)";
	}
}
