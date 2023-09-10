# EnumConcern - A PHP Package for Effortless Enumeration Handling 📦 ✨

EnumConcern is a PHP package designed to enhance the usage of PHP's Enum feature with a set of convenient methods. This package includes a Trait file that enables easy handling of Enums.

Powered by [Laravel Collections](https://laravel.com/docs/10.x/collections) to make you feel at home. 🧡
<hr/>

## Installation
To install EnumConcern package, require it via composer:

```bash
composer require emreyarligan/enum-concern
```
Now, you can use EnumConcern in your Enums.

```php
namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;

enum TestEnum: string
{
    use EnumConcern;
    ...
    ...
}
```
<hr/>

## Methods
| Method                | Description                                                                                   | Parameters                                                 | Return Type |
|-----------------------|-----------------------------------------------------------------------------------------------|------------------------------------------------------------|-------------|
| `all`                 | Get all the values as a Collection.                                                           | `method = ''` (optional)                                   | `Collection` |
| `allAsArray`          | Get all the values as an array.                                                               | `method = ''` (optional)                                   | `array`     |
| `has`                 | Check if a specific value exists.                                                             | `value`, `method = ''` (optional)                          | `bool`      |
| `caseExists`          | Check if a specific case (key / name) exists.                                                 | `value`, `method = ''` (optional)                          | `bool`      |
| `allCasesExists`      | Check if all the given cases (keys / names) exist.                                            | `cases`, `method = ''` (optional)                           | `bool`      |
| `anyCaseExists`       | Check if any of the given cases (keys / names) exist.                                         | `cases`, `method = ''` (optional)                           | `bool`      |
| `caseByValue`         | Get the case (key / name) for a specific value.                                               | `value`, `method = ''` (optional)                          | `string`     |
| `toJson`              | Convert all the values to a JSON string.                                                      | `method = ''` (optional),`jsonEncodeOption` (optional) | `string`    |
| `toArray`             | Convert all the values to an array.                                                           | `method = ''` (optional)                                   | `array`     |
| `toKeyValueCollection` | Convert all the values to a key-value format as a Collection.                                 | `method = ''` (optional)                                   | `Collection` |
| `toKeyValueArray`     | Convert all the values to a key-value format as an array.                                     | `method = ''` (optional)                                   | `array`     |
| `randomValue`         | Get a random value from the collection of values.                                             | `method = ''` (optional)                                   | `mixed`     |
| `randomCase`          | Get a random case (key / name) from the collection of values.                                 | None                                                       | `string`    |
| `casesCollection`     | Get all the cases (keys / names) of the Enum as a Collection.                                 | None                                                       | `Collection` |
| `casesArray`          | Get all the cases (keys / names) of the Enum as an array.                                     | None                                                       | `array`     |
| `allToArray`          | Get all the values as an array. (Alias for `toArray` method)                                  | `method = ''` (optional)                                   | `array`     |
| `only`                | Get a subset of the values as a Collection, only including the specified cases (keys / names). | `cases`,`method = ''` (optional)                            | `Collection` |
| `onlyAsArray`         | Get a subset of the values as an array, only including the specified cases (keys / names).    | `cases`, `method = ''` (optional)                           | `array`     |
| `except`              | Get a subset of the values as a Collection, excluding the specified cases (keys / names).     | `cases`, `method = ''` (optional)                           | `Collection` |
| `exceptAsArray`       | Get a subset of the values as an array, excluding the specified cases (keys / names).         | `cases`, `method = ''` (optional)                           | `array`     |
| `first`               | Get the first value in the Enum.                                                              | `method = ''` (optional)                                   | `mixed`     |
| `last`                | Get the last value in the Enum.                                                               | `method = ''` (optional)                                   | `mixed`     |
| `fromValue`           | Create an Enum object from a string value.                                                    | `value`                                                    | `object`     |
| `valueNamePairs`      | Get the key-value pairs of value and transformed value (if a method is specified).            | `method = ''` (optional)                                   | `Collection` |

<hr/>

## Basic Usage
You can check the <b>Examples with All Methods</b> section at the bellow of the document for more details.
```php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;

enum Color: string
{
    use EnumConcern;

    case RED = "Red";
    case GREEN = "Green";
    case BLUE = "Blue";

    public function translateToTurkish(): string
    {
        return match ($this) {
            self::RED    => 'Kırmızı',
            self::GREEN  => 'Yeşil',
            self::BLUE   => 'Mavi',
        };
    }
    
}

Color::all();
// Result: Illuminate\Support\Collection (7) [
//   [0] => 'Red',
//   [1] => 'Green',
//   [2] => 'Blue
// ]

Color::all('translateToTurkish');
// Result: Illuminate\Support\Collection (7) [
//   [0] => 'Kırmızı',
//   [1] => 'Yeşil',
//   [2] => 'Mavi
// ]

Color::has('Purple');
// false

Color::has('Mavi','translateToTurkish');
// true

```
<hr/>

## Examples With All Methods
## Step 1: Create Your Enum
Create an Enum class and uses the EnumConcern Trait. 

Here's an example for this paper. I created a trait about fruits for the example, isn't it ingenious? 😛

```php
namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;

enum Fruits: int
{
    use EnumConcern;

    case BANANA = 1;
    case STRAWBERRY = 2;
    case CHERRY = 3;
    case WATERMELON = 4;
    case ORANGE = 5;
    case KIWI = 6;
    case APPLE = 7;

    // Custom methods
    public function emojis(): string
    {
        return match ($this) {
            self::BANANA        => '🍌',
            self::STRAWBERRY    => '🍓',
            self::CHERRY        => '🍒',
            self::WATERMELON    => '🍉',
            self::ORANGE        => '🍊',
            self::KIWI          => '🥝',
            self::APPLE         => '🍎',
        };
    }

    public function names(): string
    {
        return match ($this) {
            self::BANANA        => 'Banana',
            self::STRAWBERRY    => 'Strawberry',
            self::CHERRY        => 'Cherry',
            self::WATERMELON    => 'Watermelon',
            self::ORANGE        => 'Orange',
            self::KIWI          => 'Kiwi',
            self::APPLE         => 'Apple',
        };
    }
}
```
<b>Note:</b> This README includes examples that are valid for both `int` and `string` types of Enum values. The EnumConcern Trait handles both types of Enum values in the same way.  This allows you to use the EnumConcern Trait for both types of Enum in your project and facilitate the handling of Enum values.

Here's string Enum example:

```php
namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;

enum Fruits: string
{
    use EnumConcern;

    case BANANA = "Delicious Banana";
    case STRAWBERRY = 'Red Strawberry';
    case CHERRY = "Sweet Cherry";
    case WATERMELON = "juicy watermelon";
    case ORANGE = "Tasty Orange";
    case KIWI = "Green Kiwi";
    case APPLE = "Crunchy Apple";
}
```
<hr/>

## Step 2: Enum Handling with EnumConcern
EnumConcern provides several convenient methods to handle your Enum values.

### all() Method
Get all the Enum values as a Collection (empty $method)
```php
Fruits::all();
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => 1
    "STRAWBERRY" => 2
    "CHERRY" => 3
    "WATERMELON" => 4
    "ORANGE" => 5
    "KIWI" => 6
    "APPLE" => 7
  ]
}
```
Get all the Enum values as a Collection using 'emojis' method
```php

Fruits::all('emojis');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => "🍌"
    "STRAWBERRY" => "🍓"
    "CHERRY" => "🍒"
    "WATERMELON" => "🍉"
    "ORANGE" => "🍊"
    "KIWI" => "🥝"
    "APPLE" => "🍎"
  ]
}
```
Get all the Enum values as a Collection using 'names' method.
```php
Fruits::all('names');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => "Banana"
    "STRAWBERRY" => "Strawberry"
    "CHERRY" => "Cherry"
    "WATERMELON" => "Watermelon"
    "ORANGE" => "Orange"
    "KIWI" => "Kiwi"
    "APPLE" => "Apple"
  ]
}
```
<hr/>

### has() method
Check if a specific value exists (empty $method)
```php
Fruits::has(1);

// Result: true
```

Check if a specific value exists using 'emojis' method
```php
Fruits::has('🍉', 'emojis');

// Result: true
```
Check if a specific value exists using 'names' method
```php

Fruits::has('Coconut', 'names');

// Result: false
```
<hr/>

### keyByValue() method
Get the case (key / name) for a specific value (empty $method)
```php
Fruits::keyByValue(3);

// Result: "CHERRY"
```
Get the case (key / name) for a specific value using 'emojis' method
```php
Fruits::keyByValue('🥝', 'emojis');

// Result: "KIWI"
```
Get the case (key / name) for a specific value using 'names' method
```php
Fruits::keyByValue('Orange', 'names');

// Result: "ORANGE"
```
<hr/>

### toJson() method
Convert all the values to a JSON string (empty $method)
```php
Fruits::toJson();

// Result: "{"BANANA":1,"STRAWBERRY":2,"CHERRY":3,"WATERMELON":4,"ORANGE":5,"KIWI":6,"APPLE":7}"
```
Convert all the values to a JSON string using 'emojis' method
```php
Fruits::toJson('emojis',JSON_UNESCAPED_UNICODE);

// Result: "{"BANANA":"🍌","STRAWBERRY":"🍓",...,"APPLE":"🍎"}"
```
Convert all the values to a JSON string using 'names' method
```php
Fruits::toJson('names');

// Result: "{"BANANA":"Banana","STRAWBERRY":"Strawberry","CHERRY":"Cherry","WATERMELON":"Watermelon","ORANGE":"Orange","KIWI":"Kiwi","APPLE":"Apple"}"
```
<hr/>

### toArray() method
Convert all the values to an array (empty $method)
```php
Fruits::toArray();
```
Result:
```
array:7 [
  "BANANA" => 1
  "STRAWBERRY" => 2
  "CHERRY" => 3
  "WATERMELON" => 4
  "ORANGE" => 5
  "KIWI" => 6
  "APPLE" => 7
]
```
Convert all the values to an array using 'emojis' method
```php
Fruits::toArray('emojis');
```
Result:
```
array:7 [
  "BANANA" => "🍌"
  "STRAWBERRY" => "🍓"
  "CHERRY" => "🍒"
  "WATERMELON" => "🍉"
  "ORANGE" => "🍊"
  "KIWI" => "🥝"
  "APPLE" => "🍎"
]
```
Convert all the values to an array using 'names' method
```php
Fruits::toArray('names');
```
Result:
```
array:7 [
  "BANANA" => "Banana"
  "STRAWBERRY" => "Strawberry"
  "CHERRY" => "Cherry"
  "WATERMELON" => "Watermelon"
  "ORANGE" => "Orange"
  "KIWI" => "Kiwi"
  "APPLE" => "Apple"
]
```
<hr/>

### toKeyValueCollection() method
Convert all the values to a key-value format as a Collection (empty $method)
```php
Fruits::toKeyValueCollection();
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => array:2 [
      "key" => "BANANA"
      "value" => 1
    ]
    "STRAWBERRY" => array:2 [
      "key" => "STRAWBERRY"
      "value" => 2
    ]
    "CHERRY" => array:2 [
      "key" => "CHERRY"
      "value" => 3
    ]
    "WATERMELON" => array:2 [
      "key" => "WATERMELON"
      "value" => 4
    ]
    "ORANGE" => array:2 [
      "key" => "ORANGE"
      "value" => 5
    ]
    "KIWI" => array:2 [
      "key" => "KIWI"
      "value" => 6
    ]
    "APPLE" => array:2 [
      "key" => "APPLE"
      "value" => 7
    ]
  ]
}
```
Convert all the values to a key-value format as a Collection with keyAttributeName and valueAttributeName parameters (empty $method)
```php
Fruits::toKeyValueCollection(keyAttributeName: 'foo', valueAttributeName: 'bar');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => array:2 [
      "foo" => "BANANA"
      "bar" => 1
    ]
    "STRAWBERRY" => array:2 [
      "foo" => "STRAWBERRY"
      "bar" => 2
    ]
    "CHERRY" => array:2 [
      "foo" => "CHERRY"
      "bar" => 3
    ]
    "WATERMELON" => array:2 [
      "foo" => "WATERMELON"
      "bar" => 4
    ]
    "ORANGE" => array:2 [
      "foo" => "ORANGE"
      "bar" => 5
    ]
    "KIWI" => array:2 [
      "foo" => "KIWI"
      "bar" => 6
    ]
    "APPLE" => array:2 [
      "foo" => "APPLE"
      "bar" => 7
    ]
  ]
}
```
Convert all the values to a key-value format as a Collection using 'emojis' method
```php
Fruits::toKeyValueCollection('emojis');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => array:2 [
      "key" => "BANANA"
      "value" => "🍌"
    ]
    "STRAWBERRY" => array:2 [
      "key" => "STRAWBERRY"
      "value" => "🍓"
    ]
    "CHERRY" => array:2 [
      "key" => "CHERRY"
      "value" => "🍒"
    ]
    "WATERMELON" => array:2 [
      "key" => "WATERMELON"
      "value" => "🍉"
    ]
    "ORANGE" => array:2 [
      "key" => "ORANGE"
      "value" => "🍊"
    ]
    "KIWI" => array:2 [
      "key" => "KIWI"
      "value" => "🥝"
    ]
    "APPLE" => array:2 [
      "key" => "APPLE"
      "value" => "🍎"
    ]
  ]
}
```
Convert all the values to a key-value format as a Collection using 'emojis' method with keyAttributeName and valueAttributeName parameters
```php
Fruits::toKeyValueCollection('emojis','foo','bar');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => array:2 [
      "foo" => "BANANA"
      "bar" => "🍌"
    ]
    "STRAWBERRY" => array:2 [
      "foo" => "STRAWBERRY"
      "bar" => "🍓"
    ]
    "CHERRY" => array:2 [
      "foo" => "CHERRY"
      "bar" => "🍒"
    ]
    "WATERMELON" => array:2 [
      "foo" => "WATERMELON"
      "bar" => "🍉"
    ]
    "ORANGE" => array:2 [
      "foo" => "ORANGE"
      "bar" => "🍊"
    ]
    "KIWI" => array:2 [
      "foo" => "KIWI"
      "bar" => "🥝"
    ]
    "APPLE" => array:2 [
      "foo" => "APPLE"
      "bar" => "🍎"
    ]
  ]
}
```
Convert all the values to a key-value format as a Collection using 'names' method
```php
Fruits::toKeyValueCollection('names');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => array:2 [
      "key" => "BANANA"
      "value" => "Banana"
    ]
    "STRAWBERRY" => array:2 [
      "key" => "STRAWBERRY"
      "value" => "Strawberry"
    ]
    "CHERRY" => array:2 [
      "key" => "CHERRY"
      "value" => "Cherry"
    ]
    "WATERMELON" => array:2 [
      "key" => "WATERMELON"
      "value" => "Watermelon"
    ]
    "ORANGE" => array:2 [
      "key" => "ORANGE"
      "value" => "Orange"
    ]
    "KIWI" => array:2 [
      "key" => "KIWI"
      "value" => "Kiwi"
    ]
    "APPLE" => array:2 [
      "key" => "APPLE"
      "value" => "Apple"
    ]
  ]
}
```
Convert all the values to a key-value format as a Collection using 'names' method with keyAttributeName and valueAttributeName parameters.
```php
Fruits::toKeyValueCollection('names', 'foo', 'bar');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:7 [
    "BANANA" => array:2 [
      "foo" => "BANANA"
      "bar" => "Banana"
    ]
    "STRAWBERRY" => array:2 [
      "foo" => "STRAWBERRY"
      "bar" => "Strawberry"
    ]
    "CHERRY" => array:2 [
      "foo" => "CHERRY"
      "bar" => "Cherry"
    ]
    "WATERMELON" => array:2 [
      "foo" => "WATERMELON"
      "bar" => "Watermelon"
    ]
    "ORANGE" => array:2 [
      "foo" => "ORANGE"
      "bar" => "Orange"
    ]
    "KIWI" => array:2 [
      "foo" => "KIWI"
      "bar" => "Kiwi"
    ]
    "APPLE" => array:2 [
      "foo" => "APPLE"
      "bar" => "Apple"
    ]
  ]
}
```
<hr/>

### toKeyValueArray() method
Convert all the values to a key-value format as an array (empty $method)
```php
Fruits::toKeyValueArray();
```
Result:
```
array:7 [
  0 => array:2 [
    "key" => "BANANA"
    "value" => 1
  ]
  1 => array:2 [
    "key" => "STRAWBERRY"
    "value" => 2
  ]
  2 => array:2 [
    "key" => "CHERRY"
    "value" => 3
  ]
  3 => array:2 [
    "key" => "WATERMELON"
    "value" => 4
  ]
  4 => array:2 [
    "key" => "ORANGE"
    "value" => 5
  ]
  5 => array:2 [
    "key" => "KIWI"
    "value" => 6
  ]
  6 => array:2 [
    "key" => "APPLE"
    "value" => 7
  ]
]

```
Convert all the values to a key-value format as an array with keyAttributeName and valueAttributeName parameters (empty $method)
```php
Fruits::toKeyValueArray(keyAttributeName: 'foo', valueAttributeName: 'bar');
```
Result:
```
array:7 [
  0 => array:2 [
    "foo" => "BANANA"
    "bar" => 1
  ]
  1 => array:2 [
    "foo" => "STRAWBERRY"
    "bar" => 2
  ]
  2 => array:2 [
    "foo" => "CHERRY"
    "bar" => 3
  ]
  3 => array:2 [
    "foo" => "WATERMELON"
    "bar" => 4
  ]
  4 => array:2 [
    "foo" => "ORANGE"
    "bar" => 5
  ]
  5 => array:2 [
    "foo" => "KIWI"
    "bar" => 6
  ]
  6 => array:2 [
    "foo" => "APPLE"
    "bar" => 7
  ]
]
```
Convert all the values to a key-value format as an array using 'emojis' method
```php
Fruits::toKeyValueArray('emojis');
```
Result:
```
array:7 [
  0 => array:2 [
    "key" => "BANANA"
    "value" => "🍌"
  ]
  1 => array:2 [
    "key" => "STRAWBERRY"
    "value" => "🍓"
  ]
  2 => array:2 [
    "key" => "CHERRY"
    "value" => "🍒"
  ]
  3 => array:2 [
    "key" => "WATERMELON"
    "value" => "🍉"
  ]
  4 => array:2 [
    "key" => "ORANGE"
    "value" => "🍊"
  ]
  5 => array:2 [
    "key" => "KIWI"
    "value" => "🥝"
  ]
  6 => array:2 [
    "key" => "APPLE"
    "value" => "🍎"
  ]
]
```
Convert all the values to a key-value format as an array using 'emojis' method with keyAttributeName and valueAttributeName parameters (empty $method)
```php
Fruits::toKeyValueArray('emojis','foo','bar');
```
Result:
```
array:7 [
  0 => array:2 [
    "foo" => "BANANA"
    "bar" => "🍌"
  ]
  1 => array:2 [
    "foo" => "STRAWBERRY"
    "bar" => "🍓"
  ]
  2 => array:2 [
    "foo" => "CHERRY"
    "bar" => "🍒"
  ]
  3 => array:2 [
    "foo" => "WATERMELON"
    "bar" => "🍉"
  ]
  4 => array:2 [
    "foo" => "ORANGE"
    "bar" => "🍊"
  ]
  5 => array:2 [
    "foo" => "KIWI"
    "bar" => "🥝"
  ]
  6 => array:2 [
    "foo" => "APPLE"
    "bar" => "🍎"
  ]
]
```
Convert all the values to a key-value format as an array using 'names' method
```php
Fruits::toKeyValueArray('names');
```
Result:
```
array:7 [
  0 => array:2 [
    "key" => "BANANA"
    "value" => "Banana"
  ]
  1 => array:2 [
    "key" => "STRAWBERRY"
    "value" => "Strawberry"
  ]
  2 => array:2 [
    "key" => "CHERRY"
    "value" => "Cherry"
  ]
  3 => array:2 [
    "key" => "WATERMELON"
    "value" => "Watermelon"
  ]
  4 => array:2 [
    "key" => "ORANGE"
    "value" => "Orange"
  ]
  5 => array:2 [
    "key" => "KIWI"
    "value" => "Kiwi"
  ]
  6 => array:2 [
    "key" => "APPLE"
    "value" => "Apple"
  ]
]
```
Convert all the values to a key-value format as an array using 'names' method with keyAttributeName and valueAttributeName parameters (empty $method)
```php
Fruits::toKeyValueArray('names','foo','bar');
```
Result:
```
array:7 [
  0 => array:2 [
    "foo" => "BANANA"
    "bar" => "Banana"
  ]
  1 => array:2 [
    "foo" => "STRAWBERRY"
    "bar" => "Strawberry"
  ]
  2 => array:2 [
    "foo" => "CHERRY"
    "bar" => "Cherry"
  ]
  3 => array:2 [
    "foo" => "WATERMELON"
    "bar" => "Watermelon"
  ]
  4 => array:2 [
    "foo" => "ORANGE"
    "bar" => "Orange"
  ]
  5 => array:2 [
    "foo" => "KIWI"
    "bar" => "Kiwi"
  ]
  6 => array:2 [
    "foo" => "APPLE"
    "bar" => "Apple"
  ]
]
```
<hr/>

### randomValue() method
Get a random value from the collection of values (empty $method)
```php
Fruits::randomValue();

// Result: int(4)
```
Get a random value from the collection of values using 'emojis' method
```php
Fruits::randomValue('emojis');

// Result: string(4) "🍊"
```
Get a random value from the collection of values using 'names' method
```php
Fruits::randomValue('names');

// Result: string(6) "Kiwi"
```
<hr/>

### randomKey() method
Get a random case (key / name) from the collection of values
```php
Fruits::randomKey();

// Result: string(7) "KIWI"
```
### only() Method
Get values of only certain keys as a Collection (empty $method)
```php
Fruits::only(['STRAWBERRY','CHERRY','WATERMELON','ORANGE']);
```
Result:
```
Illuminate\Support\Collection {
  #items: array:4 [
    "STRAWBERRY" => 2
    "CHERRY" => 3
    "WATERMELON" => 4
    "ORANGE" => 5
  ]
}
```
Get values of only certain keys as a Collection using 'emojis' method
```php
Fruits::only(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'emojis');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:4 [
    "STRAWBERRY" => "🍓"
    "CHERRY" => "🍒"
    "WATERMELON" => "🍉"
    "ORANGE" => "🍊"
  ]
}
```
Get values of only certain keys as a Collection using 'names' method
```php
Fruits::only(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'names');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:4 [
    "STRAWBERRY" => "Strawberry"
    "CHERRY" => "Cherry"
    "WATERMELON" => "Watermelon"
    "ORANGE" => "Orange"
  ]
}
```
<hr/>

### onlyAsArray() Method
Get values of only certain keys as an array (empty $method)
```php
Fruits::onlyAsArray(['STRAWBERRY','CHERRY','WATERMELON','ORANGE']);
```
Result:
```
array:4 [
  "STRAWBERRY" => 2
  "CHERRY" => 3
  "WATERMELON" => 4
  "ORANGE" => 5
]
```
Get values of only certain keys as an array using 'emojis' method
```php
Fruits::onlyAsArray(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'emojis');
```
Result:
```
array:4 [
  "STRAWBERRY" => "🍓"
  "CHERRY" => "🍒"
  "WATERMELON" => "🍉"
  "ORANGE" => "🍊"
]
```
Get values of only certain keys as an array using 'names' method
```php
Fruits::onlyAsArray(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'names');

```
Result:
```
array:4 [
  "STRAWBERRY" => "Strawberry"
  "CHERRY" => "Cherry"
  "WATERMELON" => "Watermelon"
  "ORANGE" => "Orange"
]
```
<hr/>

### except() Method
Get all values except certain keys as a Collection (empty $method)
```php
Fruits::except(['STRAWBERRY','CHERRY','WATERMELON','ORANGE']);
```
Result:
```
Illuminate\Support\Collection {
  #items: array:3 [
    "BANANA" => 1
    "KIWI" => 6
    "APPLE" => 7
  ]
}
```
Get all values except certain keys a Collection using 'emojis' method
```php
Fruits::except(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'emojis');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:3 [
    "BANANA" => "🍌"
    "KIWI" => "🥝"
    "APPLE" => "🍎"
  ]
}
```
Get all values except certain keys a Collection using 'names' method
```php
Fruits::except(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'names');
```
Result:
```
Illuminate\Support\Collection {
  #items: array:3 [
    "BANANA" => "Banana"
    "KIWI" => "Kiwi"
    "APPLE" => "Apple"
  ]
}
```
<hr/>

### exceptAsArray() Method
Get all values except certain keys as an array (empty $method)
```php
Fruits::exceptAsArray(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'])
```
Result:
```
array:3 [
  "BANANA" => 1
  "KIWI" => 6
  "APPLE" => 7
]
```
Get all values except certain keys an array using 'emojis' method
```php
Fruits::exceptAsArray(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'emojis');
```
Result:
```
array:3 [
  "BANANA" => "🍌"
  "KIWI" => "🥝"
  "APPLE" => "🍎"
]
```
Get all values except certain keys an array using 'names' method
```php
Fruits::exceptAsArray(['STRAWBERRY','CHERRY','WATERMELON','ORANGE'],'names');
```
Result:
```
array:3 [
  "BANANA" => "Banana"
  "KIWI" => "Kiwi"
  "APPLE" => "Apple"
]
```
<hr/>

### first() Method
Get the first value from the Enum (empty $method)
```php
Fruits::first();
// Result: int(1)
```
Get the first value from the Enum using 'emojis' method
```php
Fruits::first('emojis');
// Result: "🍌"
```
Get the first value from the Enum using 'names' method
```php
Fruits::first('names');
// Result: "Banana"
```
<hr />

### last() Method
Get the last value from the Enum (empty $method)
```php
Fruits::last();
// Result: 7
```
Get the last value from the Enum using 'emojis' method
```php
Fruits::last('emojis');
// Result: "🍎"
```
Get the last value from the Enum using 'names' method
```php
Fruits::last('names');
// Result: "Apple"
```
<hr />

### fromValue() Method
Create an Enum object from a string value.
```php
$greenEnum = Color::fromValue("Green");
// Result:
// App\Enums\Color {
//   +name: "GREEN"
//   +value: "Green"
// }
```
If the value "Green" exists in the `Color` Enum, this method will return the corresponding Enum object. If not, it will throw an `InvalidArgumentException`.

### valueNamePairs() Method
Get the key-value pairs of value and transformed value (if a method is specified).

```php
$pairs = Color::valueNamePairs('translateToTurkish');
// Result:
// Illuminate\Support\Collection {
//    "Red" => "Kırmızı",
//    "Green" => "Yeşil",
//    "Blue" => "Mavi"
// }
```
<ht />

## Tests
```bash
composer test
```
