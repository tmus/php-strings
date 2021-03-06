<?php

use PHPUnit\Framework\TestCase;
use Tommus\String\Stringo;
use phpDocumentor\Reflection\Types\Void_;

class StringTest extends TestCase
{
    public function testCanCreateUsingFromMethod() : void
    {
        $string = Stringo::from('test');

        $this->assertInstanceOf(Stringo::class, $string);
    }

    public function testToStringReturnsString() : void
    {
        $string = Stringo::from('test');

        $this->assertEquals('test', (string) $string);
    }

    public function testCanCallStaticMethods() : void
    {
        $this->assertEquals(
            Stringo::from('test')->capitalize(),
            Stringo::fromCapitalize('test')
        );
    }

    /**
     * String.at
     */
    public function testCanGetCharacterAtPosition() : void
    {
        $string = Stringo::from('tester');

        $this->assertEquals('e', $string->at(1));
        $this->assertEquals('r', $string->at(-1));
    }

    /**
     * String.capitalize
     */
    public function testCanCapitalize() : void
    {
        $this->assertEquals('Test this', Stringo::from('test this')->capitalize());
        $this->assertEquals('Test this', Stringo::from('TEST THIS')->capitalize());

        // TODO: Implement this.
        // $this->assertEquals('Fin', Stringo::from('ﬁn')->capitalize());
    }

    /**
     * String.graphemes
     */
    public function testCanGetGraphemes() : void
    {
        $string = Stringo::from('test this');

        $this->assertTrue(is_array($string->graphemes()));
        $this->assertCount(9, $string->graphemes());
    }

    public function testCanRemoveGraphemeAtPosition() : void
    {
        $string = Stringo::from('tommy');

        $this->assertEquals('tomy', $string->removeGrapheme(2));
    }

    /**
     * String.contains?
     */
    public function testCanCheckIfContainsSubstring() : void
    {
        $string = Stringo::from('check this cool test');

        $this->assertTrue($string->contains('cool'));
        $this->assertTrue($string->contains(['cool', 'piff']));
        $this->assertFalse($string->contains(['lame', 'rubbish']));

        $string2 = Stringo::from('22');

        $this->assertTrue($string2->contains(22));
    }

    /**
     * String.downcase
     */
    public function testCanDowncase() : void
    {
        $string = Stringo::from('WHAT');

        $this->assertEquals('what', $string->downcase());
        $this->assertEquals('what', $string->lowercase());
    }

    /**
     * String.duplicate
     */
    public function testCanDuplicate() : void
    {
        $string = Stringo::from('beetlejuice');

        $this->assertEquals('', $string->duplicate(0));
        $this->assertEquals('beetlejuicebeetlejuicebeetlejuice', $string->duplicate(3));
    }

    /**
     * String.ends_with?
     */
    public function testCanCheckIfEndsWithString() : void
    {
        $string = Stringo::from('kingdom');

        $this->assertTrue($string->endsWith('dom'));
        $this->assertTrue($string->endsWith(['tom', 'dom']));
        $this->assertFalse($string->endsWith(['tom', 'lucy']));

        $string = Stringo::from('22');
        $this->assertTrue($string->endsWith(2));
    }

    /**
     * String.equivalent?
     */
    public function testCanCompareTwo() : void
    {
        $firstString = Stringo::from('example');
        $secondString = Stringo::from('example');

        $this->assertTrue($firstString->equivalentTo($secondString));
    }

    /**
     * String.first
     */
    public function testCanGetFirstLetter() : void
    {
        $string = Stringo::from('test');

        $this->assertEquals('t', $string->first());
    }

    /**
     * String.last
     */
    public function testCanGetLastLetter() : void
    {
        $string = Stringo::from('testing');

        $this->assertEquals('g', $string->last());
    }

    public function testCanGetFirstWord() : void
    {
        $string = Stringo::from('prestige wordwide');

        $this->assertEquals('prestige', $string->firstWord());
    }

    public function testCanGetLastWord() : void
    {
        $string = Stringo::from('hello world');

        $this->assertEquals('world', $string->lastWord());
    }

    /**
     * String.length
     */
    public function testCanGetLength() : void
    {
        $string = Stringo::from('four');

        $this->assertEquals(4, $string->length());
    }

    public function testCanMatchRegex() : void
    {
        // TODO: These tests probably aren't complete. But it's ok for now.
        $this->assertTrue(Stringo::from('foo')->matches('/foo/'));
        $this->assertFalse(Stringo::from('bar')->matches('/foo/'));
    }

    public function testCanPad() : void
    {
        $string = Stringo::from('test');

        $this->assertEquals(' test', $string->pad(5));
        $this->assertEquals('------test', $string->padLeft(10, '-'));
        $this->assertEquals('test!', $string->padRight(5, '!'));
    }

    // public function testCanReplaceSubstring() : void
    // {
    // }

    public function testCanBeReversed() : void
    {
        $string = Stringo::from('hello');

        $this->assertEquals('olleh', $string->reverse());
    }

    public function testCanSlice() : void
    {
        $string = Stringo::from('hello world');

        $this->assertInstanceOf(Stringo::class, $string->slice(4)[0]);

        $this->assertEquals(['', 'hello world'], $string->slice(0));
        $this->assertEquals(['hello', ' world'], $string->slice(5));
        $this->assertEquals(['he', 'llo world'], $string->slice(2));
    }

    public function testCanSplit() : void
    {
        $this->assertEquals(['hello', 'world'], Stringo::from('hello world')->split());
        $this->assertEquals(['hello', 'world'], Stringo::from(' hello    world ')->split());
        $this->assertEquals(['milk', 'eggs'], Stringo::from('milk,eggs')->split(','));
        $this->assertEquals(['milk', 'eggs'], Stringo::from('milk,,,eggs')->split(','));
    }

    public function testCanCheckStartsWith() : void
    {
        $string = Stringo::from('kingdom');

        $this->assertTrue($string->startsWith('king'));
        $this->assertTrue($string->startsWith(['king', 'queen']));
        $this->assertFalse($string->startsWith(['prince', 'princess']));

        $string2 = Stringo::from('22');
        $this->assertTrue($string2->startsWith(22));
    }

    public function testCanCastToInteger() : void
    {
        $this->assertEquals(3, Stringo::from('3')->toInteger());
        $this->assertEquals(3, Stringo::from('3.14')->toInteger());
    }

    public function testCanTrim() : void
    {
        $this->assertEquals('trimmed  ', Stringo::from('   trimmed  ')->leftTrim());
        $this->assertEquals('  trimmed', Stringo::from('  trimmed')->rightTrim());
        $this->assertEquals('trimmed', Stringo::from('   trimmed    ')->trim());
    }

    public function testCanUpcase() : void
    {
        $this->assertEquals('LOUD NOISES', Stringo::from('loud noises')->upcase());
        $this->assertEquals('LOUD NOISES', Stringo::from('loud noises')->uppercase());
    }

    public function testCanCheckIsEmpty() : void
    {
        $this->assertTrue(Stringo::from(null)->isEmpty());
        $this->assertTrue(Stringo::from('')->isEmpty());
        $this->assertFalse(Stringo::from('test')->isEmpty());
    }

    public function testCanCheckIsNotEmpty() : void
    {
        $this->assertTrue(Stringo::from('test')->isNotEmpty());
        $this->assertFalse(Stringo::from(null)->isNotEmpty());
    }

    public function testCanGenerateRandom() : void
    {
        $this->assertTrue(Stringo::from(null)->generateRandom()->isNotEmpty());
        $this->assertEquals(16, Stringo::from(null)->generateRandom(16)->length());
    }

    public function testCanGetTitleCase() : void
    {
        $this->assertEquals("It's the End of the World!", Stringo::from("it's the end of the world!")->titleCase());
        $this->assertEquals("It's The End Of The World!", Stringo::from("it's the end of the world!")->titleCase(true));
    }

    // public function testCanGetCamelCase() : void
    // {
    // }

    // public function testCanGetStudlyCase() : void
    // {
    // }

    public function testCanGetSnakeCase() : void
    {
        $this->assertEquals('studly_caps', Stringo::from('StudlyCaps')->snake());
        $this->assertEquals('camel_case', Stringo::from('camelCase')->snake());
        // TODO: Could probably do with a few more examples.
    }

    public function testCanGetKebabCase() : void
    {
        $this->assertEquals('studly-caps', Stringo::from('StudlyCaps')->kebab());
        $this->assertEquals('camel-case', Stringo::from('camelCase')->kebab());
        // TODO: Add more examples here too.
    }
}
