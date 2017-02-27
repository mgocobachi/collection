<p align="center">
<a href="https://travis-ci.org/mgocobachi/collection"><img src="https://travis-ci.org/mgocobachi/collection.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/mgocobachi/collection"><img src="https://poser.pugx.org/mgocobachi/collection/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/mgocobachi/collection"><img src="https://poser.pugx.org/mgocobachi/collection/license.svg" alt="License"></a>
</p>

# Collection

A Collection class to manipulate the arrays with
enriched routines and the ability of executing
them in chain.

## Helper

The function 'collection()' exist and accept an array as parameter.
This function creates a new Collection object and passing the array
as parameter.

## Examples

In this example, we want to get the first element of the array

```
<?php
echo collection([1, 2, 3])->first();

```
And the result is:
```
1
```
We want all the emails from the users and omit those having null value.

```
<?php
$users = [
  [
    'name'  => 'John',
    'email' => 'john@doe.com',
  ],
  [
    'name'  => 'Clark',
    'email' => null,
  ],
  [
    'name'  => 'Jennifer',
    'email' => 'jennifer@email.com',
  ],
  [
    'name'  => 'Jimmy',
    'email' => null,
  ],
];

$users = collection($users)->filter(function ($user) {
  return !empty($user);
})->all();

var_dump($users);
```
And the result is:

```
array(2) {
  [0] =>
  string(12) "john@doe.com"
  [2] =>
  string(18) "jennifer@email.com"
}
```

Hope you enjoy it as I do!
