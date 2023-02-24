# Install
```bash
composer require bermudaphp/data-object
```
# Create
```php
$object = new DataObj(['name' => 'Sarah', 'age' => 25]);
```
# Get property
```php
$name = $object->name; // Sarah;
$sex = $object->get('sex', 'woman'); // woman
```
# Iteration
```php
foreach($object as $name => $value)
{
    echo 'property name: ' . $name . 'property value: ' . $value ;
}
```
# Exist property
```php
isset($object->name); // true
$object->has('sex'); // false
```
# Set property
```php
$object->sex = 'woman';
$object->set('sex', 'woman');
```
# Remove property
```php
unset($object->sex);
$object->remove('sex');
```
