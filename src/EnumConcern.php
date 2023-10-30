<?php
namespace EmreYarligan\EnumConcern;

use Illuminate\Support\Collection;

trait EnumConcern
{
    /**
     * Get all the values as a Collection.
     *
     * @param string $method (optional) If provided, the specified method will be called on each value.
     * @return Collection Returns a Collection containing the values.
     */
    public static function all(string $method = '') : Collection
    {
         if (!method_exists(self::class,$method))
             return collect(self::cases())->pluck('value','name');

         return collect(self::cases())->mapWithKeys(function ($item) use ($method) {
            return [$item->name => self::from($item->value)->$method()];
         });
    }

    /**
     * Check if a specific value exists.
     *
     * @param string $value The value to check for existence.
     * @param string $method (optional) If provided, the specified method will be called on each value before checking.
     * @return bool Returns true if the value exists, false otherwise.
     */
    public static function has(string $value, string $method = '') : bool
    {
        return self::all($method)->contains($value);
    }

    /**
     * Check if a specific case (key / name) exists.
     *
     * @param string $case The case (key / name) to check for existence.
     * @return bool Returns true if the case (key / name) exists, false otherwise.
     */
    public static function caseExists(string $case) : bool
    {
        return self::all()->has($case);
    }

    /**
     * Check if all the given cases (keys / names) exist.
     *
     * @param array $cases An array of cases (keys / names) to check for existence.
     * @return bool Returns true if all the cases (keys / names) exist, false otherwise.
     */
    public static function allCasesExists(array $cases) : bool
    {
        return self::all()->has($cases);
    }

    /**
     * Check if any of the given cases (keys / names) exist.
     *
     * @param array $cases An array of cases (keys / names) to check for existence.
     * @return bool Returns true if any of the cases (keys / names) exist, false otherwise.
     */
    public static function anyCaseExists(array $cases) : bool
    {
        return self::all()->hasAny($cases);
    }

    /**
     * Get the case (key / name) for a specific value.
     *
     * @param string $case The value to find the case for.
     * @param string $method (optional) If provided, the specified method will be called on each value before searching.
     * @return bool|string Returns the case (key / name) for the given value, or false if not found.
     */
    public static function caseByValue(?string $case, string $method = '') : string|bool
    {
        return self::all($method)->search($case);
    }

    /**
     * Convert all the values to a JSON string.
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before conversion.
     * @param int $options (optional) Bitmask of JSON encode options.
     * @return string Returns a JSON representation of the values.
     */
    public static function toJson(string $method = '', int $options = 0) : string
    {
        return self::all($method)->toJson($options);
    }

    /**
     * Convert all the values to an array.
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before conversion.
     * @return array Returns an array representation of the values.
     */
    public static function toArray(string $method = '') : array
    {
        return self::all($method)->toArray();
    }

    /**
     * Convert all the values to a key-value format as a Collection.
     *
     * @param string $keyAttributeName (optional) The attribute name to be used for the keys in the resulting key-value pairs.
     * @param string $valueAttributeName (optional) The attribute name to be used for the values in the resulting key-value pairs.
     * @return Collection Returns a Collection with key-value pairs.
     */
    public static function toKeyValueCollection(string $method = '', string $keyAttributeName = 'key', string $valueAttributeName = 'value') : Collection
    {
        return self::all($method)->map(function ($value, $key) use ($keyAttributeName, $valueAttributeName)  {
            return [
                $keyAttributeName   => $key,
                $valueAttributeName => $value,
            ];
        });
    }

    /**
     * Convert all the values to a key-value format as an array.
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before conversion.
     * @param string $keyAttributeName (optional) The attribute name to be used for the keys in the resulting key-value pairs.
     * @param string $valueAttributeName (optional) The attribute name to be used for the values in the resulting key-value pairs.
     * @return array Returns an array with key-value pairs.
     */
    public static function toKeyValueArray(string $method = '', string $keyAttributeName = 'key', string $valueAttributeName = 'value') : array
    {
        return self::toKeyValueCollection($method,$keyAttributeName,$valueAttributeName)->values()->toArray();
    }

    /**
     * Get a random value from the collection of values.
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before retrieval.
     * @return mixed Returns a random value from the collection of values.
     */
    public static function randomValue(string $method = '') : mixed
    {
        return self::all($method)->random();
    }

    /**
     * Get a random case (key / name) from the collection of values.
     *
     * @return bool|string Returns a random case (key / name) from the collection of values.
     */
    public static function randomCase() : string|bool
    {
        return self::caseByValue(self::all()->random());
    }

    /**
     * Get all the cases (keys / names) of the Enum as a Collection.
     *
     * @return Collection
     */
    public static function casesCollection() : Collection
    {
        return self::all()->keys();
    }

    /**
     * Get all the keys (keys / names) of the Enum as an array.
     *
     * @return array
     */
    public static function casesArray() : array
    {
        return self::casesCollection()->toArray();
    }

    /**
     * Get all the values as an array.
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before conversion.
     * @return array Returns an array representation of the values.
     */
    public static function allToArray(string $method = '') : array
    {
        return self::toArray($method);
    }

    /**
     * Get a subset of the values as a Collection, only including the specified cases (keys).
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before filtering.
     * @param array $cases The cases (keys) to include in the subset.
     * @return Collection Returns a Collection containing the subset of values.
     */
    public static function only(array $cases = [], string $method = '') : Collection
    {
        return self::all($method)->only($cases);
    }

    /**
     * Get a subset of the values as an array, only including the specified cases (keys / names).
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before filtering.
     * @param array $cases The cases (keys / names) to include in the subset.
     * @return array Returns an array containing the subset of values.
     */
    public static function onlyAsArray(array $cases = [], string $method = '') : array
    {
        return self::only($cases, $method)->toArray();
    }

    /**
     * Get a subset of the values as a Collection, excluding the specified cases (keys / names).
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before filtering.
     * @param array $cases The cases (keys / names) to exclude from the subset.
     * @return Collection Returns a Collection containing the subset of values.
     */
    public static function except(array $cases = [], string $method = '') : Collection
    {
        return self::all($method)->except($cases);
    }

    /**
     * Get a subset of the values as an array, excluding the specified cases (keys / names).
     *
     * @param string $method (optional) If provided, the specified method will be called on each value before filtering.
     * @param array $cases The cases (keys / names) to exclude from the subset.
     * @return array Returns an array containing the subset of values.
     */
    public static function exceptAsArray(array $cases = [], string $method = '') : array
    {
        return self::except($cases,$method)->toArray();
    }

    /**
     * Get the first value in the Enum.
     *
     * @param string $method (optional) If provided, the specified method will be called on the value before retrieval.
     * @return mixed Returns the first value in the Enum.
     */
    public static function first(string $method = '') : mixed
    {
        return self::all($method)->first();
    }

    /**
     * Get the last value in the Enum.
     *
     * @param string $method (optional) If provided, the specified method will be called on the value before retrieval.
     * @return mixed Returns the last value in the Enum.
     */
    public static function last(string $method = '') : mixed
    {
        return self::all($method)->last();
    }

    /**
     * Create an Enum object from a string value.
     *
     * @param string $value The value to match with the existing elements of the Enum.
     * @return object Returns an Enum object if the value matches an existing element.
     * @throws InvalidArgumentException if the value does not match any existing elements.
     */
    public static function fromValue(string $value) : object
    {
        if (self::has($value)) {
            return self::from($value);
        }

        throw new \InvalidArgumentException("The value '{$value}' does not match any existing elements in the Enum.");
    }

    /**
     * Get the key-value pairs of value and transformed value (if a method is specified).
     *
     * @param string $method (optional) If provided, the specified method will be called on each value.
     * @return Collection Returns a Collection containing the key-value pairs.
     */
    public static function valueNamePairs(string $method = '') : Collection
    {
        if (!method_exists(self::class, $method)) {
            return collect(self::cases())->pluck('value', 'value');
        }

        return collect(self::cases())->mapWithKeys(function ($item) use ($method) {
            return [$item->value => self::from($item->value)->$method()];
        });
    }
}
