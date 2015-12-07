# Laravel REST Documentation


## Install

Via Composer

``` bash
$ composer require imrealashu/laravelrest
```

Via composer.json

``` json
{
    "require": {
        "imrealashu/laravelrest": "0.1.*"
    }
}
```

Add to ServiceProviders array in config/app.php file

``` php
'Providers' => [
    imrealashu\laravelrest\RestServiceProvider::class
],
```
## Usage

``` bash
$ php artisan rest:install
```

The above command will ask for a 'Transformer' directory name, default "Acme" is given. It will create a directory in app directory which will containing a file name Transformer.php.

``` bash
$ php artisan rest:new ControllerName --bare
```

This command will create a bare `Transformer` class. If `bare` flag is not given it will create a `Transformer` class as well as a `Controller`.



## Example

``` bash
$ php artisan rest:new City
Creating files...
Transformer Created: /Applications/XAMPP/xamppfiles/htdocs/lpackeges/app/Acme/CityTransformer.php
Controller Created: /Applications/XAMPP/xamppfiles/htdocs/lpackeges/app/Http/Controllers/API/CitiesController.php
```

CitiesController.php

```php
<?php
namespace App\Http\Controllers\API;
use Acme\Transformers\City;
class Cities extends ApiController{
protected $CityTransformer;
	function __construct(CityTransformer $CityTransformer){
		$this->CityTransformer = $CityTransformer;
	}
public function index(){
	$data_array = [];
	return $this->respond([
		'data'=> $this->CityTransformer->transformCollection($data_array)
		]);
	}
public function show($id){
	$data_array = [];
	return $this->respond([
		'data'=> $this->CityTransformer->transformLong($data_array)
		]);
	}
}
```



