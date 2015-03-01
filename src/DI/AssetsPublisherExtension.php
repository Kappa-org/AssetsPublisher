<?php
/**
 * This file is part of the Kappa\AssetsPublisher package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\AssetsPublisher\DI;

use Nette\DI\CompilerExtension;

/**
 * Class AssetsPublisherExtension
 *
 * @package Kappa\AssetsPublisher\DI
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class AssetsPublisherExtension extends CompilerExtension
{
	private $defaultConfig = [
		'assetsDir' => '%appDir%/../www/assets'
	];

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaultConfig);
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('hashGenerator'))
			->setClass('Kappa\AssetsPublisher\Generators\HashGenerator');

		$builder->addDefinition($this->prefix('publisher'))
			->setClass('Kappa\AssetsPublisher\Publisher', [
				$this->prefix('@hashGenerator'),
				$config['assetsDir']
			]);
	}
}
