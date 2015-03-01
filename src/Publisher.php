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

	/** @var string */
	private $documentRoot;

	/** @var HashGeneratorInterface */
	private $hashGenerator;

	/**
	 * @param HashGeneratorInterface $hashGenerator
	 * @param string $documentRoot
	 * @param string $assetsDir
	 */
	public function __construct(HashGeneratorInterface $hashGenerator, $documentRoot, $assetsDir)
	{
		$this->hashGenerator = $hashGenerator;
		$this->documentRoot = $documentRoot;
		$this->assetsDir = $assetsDir;
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
		$path = $this->documentRoot . DIRECTORY_SEPARATOR . $assetsDir . DIRECTORY_SEPARATOR . $hash . '.' . $ext;
		if (!file_exists($path)) {
			FileSystem::copy($source, $path, false);
		}

		return str_replace($this->documentRoot, '', realpath($path));
	}

	/**
	 * @return string
	 */
	private function getAssetsDir()
	{
		$dir = $this->documentRoot . DIRECTORY_SEPARATOR . $this->assetsDir;
		if (!is_dir($dir)) {
			FileSystem::createDir($dir);
		}

		return $this->assetsDir;
	}
}
