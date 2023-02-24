# Install
```bash
composer require bermudaphp/data-object
```
# Create
```php
$obj = new DataObj(['name' => 'Sarah', 'age' => 25]);
or
$data = new StdClass();

$data->name = 'Sarah';
$data->age = 25;

$obj = new DataObj($data);
```
# Get property
```php
$name = $obj->name; // Sarah;
$sex = $obj->get('sex', 'woman'); // woman
$name = $obj['name']; // Sarah
```
# Iteration
```php
foreach($obj as $name => $value) echo 'property name: ' . $name . 'property value: ' . $value ;
```
# Exist property
```php
isset($object->name); // true
$obj->has('name'); // true
isset($obj['name']) // true
$obj->offsetExists('name') // true
```
# Set property
```php
$obj->sex = 'woman';
$obj->set('sex', 'woman');
$obj['sex'] = 'woman';
```
# Remove property
```php
unset($obj->sex);
$obj->remove('sex');
$obj->offsetUnset('sex');
unset($obj['sex']);
```
