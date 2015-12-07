# Laravel Rest API Generator and Transformers

[![Latest Version on Packagist][ico-version]][https://packagist.org/packages/imrealashu/laravelrest]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Ashish Singh``` ```imrealashu``` ```https://github.com/imrealashu``` ```imrealashu@gmail.com``` ```imrealashu``` ```LaravelRest``` ```Simple Laravel Package for REST API``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require imrealashu/laravelrest
```

## Usage
Add to ServiceProviders array in config/app.php file
``` php
imrealashu\laravelrest\RestServiceProvider::class
```
``` bash
$ php artisan vendor:publish
```
To install the basic skeleton
``` bash
$ php artisan rest:install
```
Create new Transformer and Controller
``` bash
$ php artisan rest:new ControllerName
```

For Complete Documentation Please see [Documentation](DOCUMENTATION.md)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.



## Security

If you discover any security related issues, please email imrealashu@gmail.com instead of using the issue tracker.

## Credits

- [Ashish Singh][https://github.com/imrealashu]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/:vendor/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/:vendor/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/:vendor/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/:vendor/:package_name
[link-travis]: https://travis-ci.org/:vendor/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/:vendor/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/:vendor/:package_name
[link-downloads]: https://packagist.org/packages/:vendor/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
