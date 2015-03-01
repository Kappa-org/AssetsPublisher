# Kappa\AssetsPublisher

Basic macros for better works with src and href attribute

## Requirements

* PHP 5.4 or higher

## Installation:

The best way to install Kappa\AssetsPublisher is using Composer

```shell
$ composer require kappa/assets-publisher:@dev
```

And register macro `Kappa\AssetsPublisher\Macros\SourceMacro`. For example

```yaml
nette:
	latte:
		macros:
			- Kappa\AssetsPublisher\Macros\SourceMacro
```

## Configuration

```yaml
documentRoot: %wwwDir%
assetsDir: assets
```

* `documentRoot` - You can set document root for all assets. Default value is %wwwDir% form parameters
* `assetsDir` - you can set name of assets dir. Default value is `assets`.

For example

```yaml
documentRoo: /super/web/www
assetsDir: public/assets
```

Real path to assets will be  `/super/web/www/public/assets` and all assets in template will have path `/public/assets`
because `/super/web/www/` is document root and will be ignored.

## Usages

Now in template you can link files placed outside of public directory

```latte
<img n:source="/not/public/directory/image.png"> {* this create <img src="/assets/fa465asd12sadad.png"> *}
<link n:source="/not/public/directory/style.css"> {* this create <link href="/assets/fa465asd12sadad.css"> *}
```
