# php-globalsnapshot

Capture the current state of all [PHP superglobal variables](https://www.php.net/manual/en/language.variables.superglobals.php); which can then be restored to that state at a later time.

Example use:
```php
// Initial state
$_ENV["hello"] = "world"; // echo: "world"

// Capture initial state
$snapshot = (new GlobalSnapshot())->capture();

// Manipulate superglobals
$_ENV["hello"] .= " and mom!"; // echo: "world and mom"

// Restore initial state
$snapshot->restore();

// Initial state restored
echo $_ENV["hello"]; // echo: "world"
```

# Quickstart

1. Install with composer
```
composer install victorwesterlund/globalsnapshot
```

2. `use` in your project
```php
use victorwesterlund\GlobalSnapshot;
```

3. Capture current superglobals with `capture()`
```php
// Initialize a new GlobalSnapshot instance to store current values (one snapshot per instance)
$snapshot = new GlobalSnapshot();

// Capture current superglobal state
$snapshot->capture();
```

3. Restore superglobals with `restore()`
```php
// ... some other code

// Restore superglobals to state of `capture()`
$snapshot->restore();
```
