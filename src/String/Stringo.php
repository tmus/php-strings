<?php

namespace Tommus\String;

class Stringo
{
    /**
     * The string held by this class.
     */
    protected $string;

    /**
     * Construct.
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * Create a new string object. Allows easy method chaining:
     *
     *   `Stringo::from('test')->capitalize();`
     */
    public static function from(string $string) : self
    {
        return new self($string);
    }

    /**
     * Returns the grapheme at the given position.
     */
    public function at(int $position) : self
    {
        $string = $this->string[$position];
        return new self($string);
    }

    /**
     * Turns a string into lowercase with an uppercase first letter.
     */
    public function capitalize() : self
    {
        $string = ucfirst($this->downcase());
        return new self($string);
    }

    /**
     * Rule Britannia!
     */
    public function capitalise() : self
    {
        return $this->capitalize();
    }

    /**
     * Returns an array of the letters that make up the array.
     */
    public function graphemes() : array
    {
        return str_split($this);
    }

    /**
     * Determine if a string contains a substring.
     */
    public function contains($values) : bool
    {
        if (! is_array($values)) {
            $values = [$values];
        }

        foreach($values as $value) {
            if (strpos($this, $value) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Turns a string into lowercase.
     */
    public function downcase() : self
    {
        $string = strtolower($this);

        return new self($string);
    }

    /**
     * Turns a string into lowercase.
     */
    public function lowercase() : self
    {
        return $this->downcase();
    }

    /**
     * Repeat a string a number of times. A `$times` of zero returns an
     * empty string.
     */
    public function duplicate(int $times = 2) : self
    {
        for ($i=0; $i < $times; $i++) {
            $repeats[] = (string) $this;
        }

        $string = $times === 0 ? '' : implode($repeats);

        return new self($string);
    }

    /**
     * Determine if a string ends with a given value.
     */
    public function endsWith($values) : bool
    {
        $thisLength = strlen($this);

        if (! is_array($values)) {
            $values = [$values];
        }

        /**
         * For each value passed, subtract it's length from the length of the string.
         * If this equals the strrpos of the passed value in the object string, then
         * it is a match.
         */
        foreach($values as $value) {
            $endIndex = $thisLength - strlen($value);
            $position = strrpos($this, $value);

            if ($endIndex === $position) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if two strings are equivalent.
     */
    public function equivalentTo(self $string) : bool
    {
        return (string) $this === (string) $string;
    }

    /**
     * Returns the first letter of a string.
     */
    public function first() : self
    {
        return $this->at(0);
    }

    /**
     * Returns the last letter of a string.
     */
    public function last() : self
    {
        return $this->at(-1);
    }

    /**
     * Returns the length of the string.
     */
    public function length() : int
    {
        return count($this->graphemes());
    }

    /**
     * Pads a string to a desired length.
     */
    public function pad(int $amount, string $string = ' ', string $side = STR_PAD_LEFT) : self
    {
        return new self(str_pad($this, $amount, $string, $side));
    }

    /**
     * Pads a string from the left.
     */
    public function padLeft(int $amount, string $string = ' ') : self
    {
        return $this->pad($amount, $string, STR_PAD_LEFT);
    }

    /**
     * Pads a string from the right.
     */
    public function padRight(int $amount, string $string = ' ') : self
    {
        return $this->pad($amount, $string, STR_PAD_RIGHT);
    }

    /**
     * Reverses the string.
     */
    public function reverse() : self
    {
        return new self(implode('', array_reverse($this->graphemes())));
    }

    /**
     * Split the string into an array.
     */
    public function split(string $character = ' ') : array
    {
        $array = explode($character, $this);

        $returnedArray = [];

        foreach($array as $value) {
            if ($value !== '') {
                $returnedArray[] = $value;
            }
        }

        return $returnedArray;
    }

    /**
     * Casts a string to an integer.
     */
    public function toInteger() : int
    {
        return (int) (string) $this;
    }

    /**
     * Converts a string to uppercase.
     */
    public function uppercase() : self
    {
        return new self(strtoupper($this));
    }

    /**
     * Converts a string to uppercase.
     */
    public function upcase() : self
    {
        return $this->uppercase();
    }

    /**
     * Returns the object as a string.
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * Map static calls to functions. This allows to shorten creation by
     * calling a function directly on a string. For example:
     *
     *   `Stringo::from('asd')->capitalize()` can be written as
     *   `Stringo::fromCapitalize('asd')`.
     */
    public static function __callStatic($name, $arguments)
    {
        $method = strtolower(str_replace('from', '', $name));
        $value = $arguments[0] ?? null;

        if (method_exists(__CLASS__, $method) && $value !== null) {
            return (new static($value))->$method();
        }
    }
}