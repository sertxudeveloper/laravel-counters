
<p align="center"><img src="/art/socialcard.png" alt="Counters"></p>

# Laravel Package Template

![](https://img.shields.io/github/v/release/sertxudeveloper/laravel-counters) ![](https://github.com/sertxudeveloper/laravel-counters/actions/workflows/tests.yml/badge.svg) ![](https://img.shields.io/github/license/sertxudeveloper/laravel-counters) ![](https://img.shields.io/github/repo-size/sertxudeveloper/laravel-counters) ![](https://img.shields.io/packagist/dt/sertxudeveloper/laravel-counters) ![](https://img.shields.io/github/issues/sertxudeveloper/laravel-counters) ![](https://img.shields.io/packagist/php-v/sertxudeveloper/laravel-counters) [![Codecov Test coverage](https://img.shields.io/codecov/c/github/sertxudeveloper/laravel-counters)](https://app.codecov.io/gh/sertxudeveloper/laravel-counters)

This template is a starting point for building Laravel packages.

Feel free to use it and modify it to your needs.

Enjoy it! 🚀

## Installation

You can install the package via composer:

```bash
composer require sertxudeveloper/laravel-counters
```

## Usage

This package provides a configuration file, in order to publish it, you should run the following command:

```bash
php artisan vendor:publish --tag=menu-config
```

In this configuration file you will be able to configure the database connection the package should use for its migrations and models.
By default, will use the default database connection defined in your Laravel project.

Next, you should run the migrations:

```bash
php artisan migrate
```

That's it! You are ready to use the package.

Here is an example of how to use the package:

### Use a basic counter

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES');

$invoice->number = $counter->next(); // 1
```

### Use a counter with a series

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES', series: 'N');

$invoice->number = $counter->next(); // 1
$invoice->number = $counter->next(); // 2

$counter = Counter::make('INVOICES', series: 'R');

$invoice->number = $counter->next(); // 1
```

### Use a counter with a year

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES', year: '2023');

$invoice->number = $counter->next(); // 1
$invoice->number = $counter->next(); // 2

$counter = Counter::make('INVOICES', year: '2024');

$invoice->number = $counter->next(); // 1
```

### Use a counter with a year and a series

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES', year: '2023', series: 'N');

$invoice->number = $counter->next(); // 1
$invoice->number = $counter->next(); // 2

$counter = Counter::make('INVOICES', year: '2023', series: 'R');

$invoice->number = $counter->next(); // 1

$counter = Counter::make('INVOICES', year: '2024', series: 'N');

$invoice->number = $counter->next(); // 1
```

### Decrement a counter

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES');

$invoice->number = $counter->next(); // 1
$invoice->number = $counter->next(); // 2

$invoice->number = $counter->decrement(); // 1
```

### Custom increment

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES');

$invoice->number = $counter->next(); // 1
$invoice->number = $counter->increment(5); // 6
```

### Custom decrement

```php
use SertxuDeveloper\Counters\Counter;

$counter = Counter::make('INVOICES');

$invoice->number = $counter->next(); // 1
$invoice->number = $counter->increment(5); // 6

$invoice->number = $counter->decrement(3); // 3
```

## Testing

This package contains tests, you can run them using the following command:

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](https://github.com/sertxudeveloper/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sergio Peris](https://github.com/sertxudev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<br><br>
<p align="center">Copyright © 2024 Sertxu Developer</p>
