# Install
```bash
composer require lobster-php/data-object
```
# Usage
```php
$object = new DataObject(['name' => 'Sarah', 'age' => 25]);

echo $object->name // Sarah;

echo $object->get('sex', 'woman'); // woman

foreach($object as $name => $value)
{
    // iteration logick
}

$object->has('sex'); // false

$object->sex = 'woman';

$object->has('sex'); // true

$object->remove('sex');

$object->has('sex'); // false
```
