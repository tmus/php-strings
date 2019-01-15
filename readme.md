# Stringo

An object oriented solution to strings in php.

## Usage

```php
// The from method creates a string from a string literal or variable.
$string = Stringo::from('hello there');

// Methods that take no arguments can be used statically:
$string = Stringo::fromCapitalize('hello'); // Hello
$string = Stringo::fromSplit('hi there friend'); // ['hi', 'there', 'friend']
```

Full API reference coming soon but for now check out the Stringo class and
StringTest for usage examples.

## Testing

```bash
composer test
```