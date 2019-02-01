<?php

namespace Tommus\String;

class Stringo
{
    /**
     * The string held by this class.
     *
     * @var string
     */
    protected $string;

    /**
     * Construct.
     *
     * @param mixed $string The string to manipilate.
     */
    public function __construct($string)
    {
        $this->string = (string) $string;
    }

    /**
     * Create a new string object. Allows easy method chaining:
     *
     *   `Stringo::from('test')->capitalize();`
     *
     * @param mixed $string The string to manipulate.
     *
     * @return self
     */
    public static function from($string) : self
    {
        return new self($string);
    }

    /**
     * Returns the grapheme at the given position.
     *
     * @param int $position The position of the grapheme that should be returned.
     *
     * @return self
     */
    public function at(int $position) : self
    {
        $string = $this->string[$position];
        return new self($string);
    }

    /**
     * Removes the grapheme at the given position.
     *
     * @param int $position The position of the grapheme to remove.
     *
     * @return self
     */
    public function removeGrapheme(int $position) : self
    {
        $graphemes = $this->graphemes();
        unset($graphemes[$position]);
        return new self(implode('', $graphemes));
    }

    /**
     * Turns a string into lowercase with an uppercase first letter.
     *
     * @return self
     */
    public function capitalize() : self
    {
        $string = ucfirst($this->downcase());
        return new self($string);
    }

    /**
     * Rule Britannia!
     *
     * @return self
     */
    public function capitalise() : self
    {
        return $this->capitalize();
    }

    /**
     * Returns an array of the letters that make up the array.
     *
     * @return array
     */
    public function graphemes() : array
    {
        $pieces = str_split($this);

        // Splitting an empty or null string returns an array with
        // one item - an empty string. If this is the case,
        // return an empty array instead.
        if (count($pieces) === 1 && $pieces[0] === '') {
            return [];
        }

        return str_split($this);
    }

    /**
     * Determine if a string contains a substring.
     *
     * @param array|mixed $values The values to check the string for.
     *
     * @return bool
     */
    public function contains($values) : bool
    {
        if (! is_array($values)) {
            $values = [$values];
        }

        foreach ($values as $value) {
            if (strpos($this, (string) $value) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a string matches a given regex pattern.
     *
     * @param string $regex The regular expression to validate the string against.
     *
     * @return bool
     */
    public function matches(string $regex) : bool
    {
        $match = preg_match($regex, $this);

        return $match === 1
            ? true
            : false;
    }

    /**
     * Turns a string into lowercase.
     *
     * @return self
     */
    public function downcase() : self
    {
        $string = strtolower($this);

        return new self($string);
    }

    /**
     * Slices a string into two pieces at a position.
     *
     * @param int $position The position to split the string on.
     *
     * @return array
     */
    public function slice(int $position) : array
    {
        $firstSlice = substr($this, 0, $position);
        $secondSlice = substr($this, $position);

        return [
            new self($firstSlice),
            new self($secondSlice),
        ];
    }

    /**
     * Turns a string into lowercase.
     *
     * @return self
     */
    public function lowercase() : self
    {
        return $this->downcase();
    }

    /**
     * Repeat a string a number of times. A `$times` of zero returns an
     * empty string.
     *
     * @param int $times The number of strings to join together.
     *
     * @return self
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
     * Determine if a string starts with a given value.
     *
     * @param array|mixed $values The values to check.
     *
     * @return bool
     */
    public function startsWith($values) : bool
    {
        if (! is_array($values)) {
            $values = [$values];
        }

        // If the strpos of a value is zero, it must occur
        // at the beginning of the string.
        foreach ($values as $value) {
            if (strpos($this, (string) $value) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a string ends with a given value.
     *
     * @param array|mixed $values The values to check.
     *
     * @return bool
     */
    public function endsWith($values) : bool
    {
        $thisLength = strlen($this);

        if (! is_array($values)) {
            $values = [$values];
        }

        // For each value passed, subtract it's length from the length of the string.
        // If this equals the strrpos of the passed value in the object string, then
        // it is a match.
        foreach ($values as $value) {
            $endIndex = $thisLength - strlen($value);
            $position = strrpos($this, (string) $value);

            if ($endIndex === $position) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if two strings are equivalent.
     *
     * @param string $string The string to compare against.
     *
     * @return bool
     */
    public function equivalentTo(string $string) : bool
    {
        return (string) $this === (string) $string;
    }

    /**
     * Returns the first letter of a string.
     *
     * @return self
     */
    public function first() : self
    {
        return $this->at(0);
    }

    /**
     * Returns the last letter of a string.
     *
     * @return self
     */
    public function last() : self
    {
        return $this->at(-1);
    }

    /**
     * Returns the length of the string.
     *
     * @return int
     */
    public function length() : int
    {
        return count($this->graphemes());
    }

    /**
     * Pads a string to a desired length.
     *
     * @param int    $amount The length to pad the string by.
     * @param string $string The string to pad the string with.
     * @param string $side   The side of the string to pad.
     *
     * @return self
     */
    public function pad(int $amount, string $string = ' ', string $side = STR_PAD_LEFT) : self
    {
        return new self(str_pad($this, $amount, $string, $side));
    }

    /**
     * Pads a string from the left.
     *
     * @param int    $amount The length to pad the string by.
     * @param string $string The string to pad the string with.
     *
     * @return self
     */
    public function padLeft(int $amount, string $string = ' ') : self
    {
        return $this->pad($amount, $string, STR_PAD_LEFT);
    }

    /**
     * Pads a string from the right.
     *
     * @param int    $amount The length to pad the string by.
     * @param string $string The string to pad the string with.
     *
     * @return self
     */
    public function padRight(int $amount, string $string = ' ') : self
    {
        return $this->pad($amount, $string, STR_PAD_RIGHT);
    }

    /**
     * Reverses the string.
     *
     * @return self
     */
    public function reverse() : self
    {
        return new self(implode('', array_reverse($this->graphemes())));
    }

    /**
     * Split the string into an array.
     *
     * @param string $character The character to split the string on.
     *
     * @return array
     */
    public function split(string $character = ' ') : array
    {
        $array = explode($character, $this);

        $returnedArray = [];

        foreach ($array as $value) {
            if ($value !== '') {
                $returnedArray[] = new self($value);
            }
        }

        return $returnedArray;
    }

    /**
     * Returns an array of the words in a string.
     *
     * @param string $character The character to split the string on.
     *
     * @return array
     */
    public function words(string $character = ' ') : array
    {
        return $this->split($character);
    }

    /**
     * Returns the first word in a string.
     *
     * @return self
     */
    public function firstWord() : self
    {
        return $this->words()[0];
    }

    /**
     * Returns the last word in a string.
     *
     * @return self
     */
    public function lastWord() : self
    {
        $words = $this->words();

        $arrayLength = count($words);

        return $words[$arrayLength - 1];
    }

    /**
     * Casts a string to an integer.
     *
     * @return int
     */
    public function toInteger() : int
    {
        return (int) (string) $this;
    }

    /**
     * Converts a string to uppercase.
     *
     * @return self
     */
    public function uppercase() : self
    {
        return new self(strtoupper($this));
    }

    /**
     * Converts a string to uppercase.
     *
     * @return self
     */
    public function upcase() : self
    {
        return $this->uppercase();
    }

    /**
     * Determine if a string is empty.
     *
     * @return bool
     */
    public function isEmpty() : bool
    {
        return $this->length() === 0;
    }

    /**
     * Determine if a string is not empty.
     *
     * @return bool
     */
    public function isNotEmpty() : bool
    {
        return ! $this->isEmpty();
    }

    /**
     * Generates a random string.
     *
     * @param int $length The length of the string to generate.
     *
     * @return self
     */
    public function generateRandom(int $length = 32) : self
    {
        $string = bin2hex(random_bytes($length));
        $string = substr($string, 0, $length);
        return new self($string);
    }

    /**
     * Formats the string nicely for a headline or subtitle.
     *
     * @param bool  $all            Whether or not to apitalise every word.
     * @param array $nonCapitalized A custom array of words that ignore capitalisation.
     *
     * @return self
     */
    public function titleCase(bool $all = false, array $nonCapitalized = null) : self
    {
        $ucwords = new self(ucwords($this));

        // If the `$all` flag is set to true, just return
        // a string with all words capitalized.
        if ($all === true) {
            return $ucwords;
        }

        $toLower = $nonCapitalized
            ?? ['A', 'An', 'And', 'The', 'But', 'For', 'Or', 'Of', 'Nor'];

        $words = array_map(
            function ($word) use ($toLower) {
                return in_array($word, $toLower) ? strtolower($word) : $word;
            },
            $ucwords->split()
        );

        $words = implode(' ', $words);

        return new self($words);
    }

    /**
     * Remove whitespace from both sides of the string.
     *
     * @return self
     */
    public function trim() : self
    {
        return new self(trim($this));
    }

    /**
     * Remove whitespace from the left side of the string.
     *
     * @return self
     */
    public function leftTrim() : self
    {
        return new self(ltrim($this));
    }

    /**
     * Remove whitespace from the right side of the string.
     *
     * @return self
     */
    public function rightTrim() : self
    {
        return new self(rtrim($this));
    }

    /**
     * Converts a string to a `snake_case` representation.
     *
     * @param string $character The character to place between words.
     *
     * @return self
     */
    public function snake(string $character = '_') : self
    {
        $string = preg_replace_callback(
            '/[A-Z]/', function ($match) use ($character) {
                return $character . $match[0];
            },
            (string) $this
        );

        $string = new self($string);

        if ((string) $string->first() === $character) {
            $string = $string->removeGrapheme(0);
        }

        return static::fromDowncase($string);
    }

    /**
     * Converts a string to a `kebab-case` representation.
     *
     * @return self
     */
    public function kebab() : self
    {
        return $this->snake('-');
    }

    /**
     * Returns the object as a string.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->string ?? '';
    }

    /**
     * Map static calls to functions. This allows to shorten creation by
     * calling a function directly on a string. For example:
     *
     *   `Stringo::from('asd')->capitalize()` can be written as
     *   `Stringo::fromCapitalize('asd')`.
     *
     * @param string $name      The name of the dynamic method called.
     * @param array  $arguments The arguments to pass to the call.
     *
     * @return self
     */
    public static function __callStatic($name, $arguments) : self
    {
        $method = strtolower(str_replace('from', '', $name));
        $value = $arguments[0] ?? null;

        if (method_exists(__CLASS__, $method) && $value !== null) {
            return (new static($value))->$method();
        }
    }
}