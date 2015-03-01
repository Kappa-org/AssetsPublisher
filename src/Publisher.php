<?php
/**
 * This file is part of the Kappa\AssetsPublisher package.
 *
 * (c) Ondřej Záruba <zarubaondra@gmail.com>
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace Kappa\AssetsPublisher;

use Kappa\AssetsPublisher\Generators\HashGeneratorInterface;
use Nette\Utils\FileSystem;

/**
 * Class Publisher
 *
 * @package Kappa\AssetsPublisher
 * @author Ondřej Záruba <http://zaruba-ondrej.cz>
 */
class Publisher
{
	/** @var string */
	private $assetsDir;

	/** @var HashGeneratorInterface */
	private $hashGenerator;

	/**
	 * @param HashGeneratorInterface $hashGenerator
	 * @param string $assetsDir
	 */
	public function __construct(HashGeneratorInterface $hashGenerator, $assetsDir)
	{
		$this->assetsDir = $assetsDir;
		$this->hashGenerator = $hashGenerator;
	}

	/**
	 * @param string $source
	 * @return string string
	 */
	public function makePublish($source)
	{
		$assetsDir = $this->getAssetsDir();
		$hash = $this->hashGenerator->getHash($source);
		$ext = pathinfo($source, PATHINFO_EXTENSION);
		$path = $assetsDir . DIRECTORY_SEPARATOR . $hash . '.' . $ext;
		if (!file_exists($path)) {
			FileSystem::copy($source, $path, false);
		}

		return $path;
	}

	/**
	 * @return string
	 */
	private function getAssetsDir()
	{
		if (!is_dir($this->assetsDir)) {
			FileSystem::createDir($this->assetsDir);
		}

		return $this->assetsDir;
	}
}
