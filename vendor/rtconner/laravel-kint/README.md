Seamless Laravel 4 / Kint Integration
============

I love Kint, but it's a little hard to get it to work perfectly within Laravel. This plugin solves that.

[Laravel 5 Documentation](https://github.com/rtconner/laravel-kint/tree/laravel-5)  
[Laravel 4 Documentation](https://github.com/rtconner/laravel-kint/tree/laravel-4)

### Installation

    composer require rtconner/laravel-kint dev-laravel-4

```php
'providers' => array(
	'Conner\Kint\KintServiceProvider',
);
```

### Usage

Use Kint as you would normally.

```php
d($var); // dump

ddd($var); // debug dump and die

s($var); // string print

sd($var); // string print and die
```

### Configure

    php artisan config:publish rtconner/laravel-kint
	# alternatively you could manually create app/config/kint.php

See [Kint documentation](http://raveren.github.io/kint/) for details on configuration options.