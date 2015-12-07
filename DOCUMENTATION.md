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
    /**
    * $data_array array
    */
	$data_array = SomeModel::select('column1','column2','column3')->get();
	return $this->respond([
		'data'=> $this->CityTransformer->setStatusCode(200)->transformCollection($data_array)
		]);
	}
public function show($id){
	$data_array = SomeModel::find($id);
	return $this->respond([
		'data'=> $this->CityTransformer->transformLong($data_array->toArray())
		]);
	}
}
```

CityTransformer.php

``` php
<?php 
namespace Acme\Transformers;
class CityTransformer extends Transformer{
	/**
	* @param $City array
	* @return array
	**/
	public function transform($item){
	return [
	    'newColumnAlias1' => $item->column1,
	    'newColumnAlias2' => $item->column2,
	    'newColumnAlias3' => $item->column3,
	 ];
	}
	/**
	* @param $City array
	* @return array
	**/public function transformLong($item){
	return [
	    'newColumnAlias1' => $item->column1,
        'newColumnAlias2' => $item->column2,
        'newColumnAlias3' => $item->column3,
        'newColumnAlias4' => $item->column4,
        'newColumnAlias5' => $item->column5,
	 ];
	}
}
```

## Output

``` json
- data {
    column1: 'something'
    column2: 'something else'
    column3: 33
}
```

#### For any Query

Just Mail me to [Ashish Singh](imrealashu@gmail.com) 