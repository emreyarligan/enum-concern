<?php

namespace EmreYarligan\EnumConcern\Tests;

use PHPUnit\Framework\TestCase;
use EmreYarligan\EnumConcern\EnumConcern;

class EnumConcernTest extends TestCase {

    public function testAll(): void
    {
        $this->assertEquals(Fruits::all(), collect([
            "BANANA" => 1,
            "STRAWBERRY" => 2,
            "CHERRY" => 3,
            "WATERMELON" => 4,
            "ORANGE" => 5,
            "KIWI" => 6,
            "APPLE" => 7,
        ]));
    }

    public function testAllWithCustomMethod(): void
    {
        $this->assertEquals(Fruits::all('emojis'), collect([
            "BANANA" => "🍌",
            "STRAWBERRY" => "🍓",
            "CHERRY" => "🍒",
            "WATERMELON" => "🍉",
            "ORANGE" => "🍊",
            "KIWI" => "🥝",
            "APPLE" => "🍎",
        ]));
    }

    public function testHasValueTrue(): void
    {
        $this->assertTrue(Fruits::has(1));
    }

    public function testHasValueFalse(): void
    {
        $this->assertFalse(Fruits::has(9));
    }

    public function testHasValueTrueWithCustomMethod(): void
    {
        $this->assertTrue(Fruits::has('🍌', 'emojis'));
    }

    public function testHasValueFalseWithCustomMethod(): void
    {
        $this->assertFalse(Fruits::has('🥥', 'emojis'));
    }

    public function testCaseExistsTrue(): void
    {
        $this->assertTrue(Fruits::caseExists('CHERRY'));
    }

    public function testCaseExistsFalse(): void
    {
        $this->assertFalse(Fruits::caseExists('COCONAT'));
    }

    public function testAllCasesExistsTrue(): void
    {
        $this->assertTrue(Fruits::allCasesExists([
            'STRAWBERRY',
            'CHERRY',
            'WATERMELON'
        ]));
    }

    public function testAllCasesExistsFalse(): void
    {
        $this->assertFalse(Fruits::allCasesExists([
            'STRAWBERRY',
            'CHERRY',
            'COCONAT'
        ]));
    }

    public function testAnyCaseExistsTrue(): void
    {
        $this->assertTrue(Fruits::anyCaseExists([
            'PLUM',
            'CHERRY',
            'COCONAT'
        ]));
    }

    public function testAnyCaseExistsFalse(): void
    {
        $this->assertFalse(Fruits::anyCaseExists([
            'PLUM',
            'MANGO',
            'COCONAT'
        ]));
    }

    public function testCaseByValue(): void
    {
        $this->assertEquals(Fruits::caseByValue(6), 'KIWI');
    }

    public function testCaseByValueWithCustomMethod(): void
    {
        $this->assertEquals(Fruits::caseByValue('🥝','emojis'), 'KIWI');
    }

    public function testToJson(): void
    {
        $expectedjsonEncodedString = '{"BANANA":1,"STRAWBERRY":2,"CHERRY":3,"WATERMELON":4,"ORANGE":5,"KIWI":6,"APPLE":7}';
        $this->assertEquals(Fruits::toJson(), $expectedjsonEncodedString);
    }

    public function testToJsonWithUnicodeOption(): void
    {
        $expectedJsonEncodedString = '{"BANANA":"🍌","STRAWBERRY":"🍓","CHERRY":"🍒","WATERMELON":"🍉","ORANGE":"🍊","KIWI":"🥝","APPLE":"🍎"}';

        $this->assertEquals(Fruits::toJson('emojis',JSON_UNESCAPED_UNICODE), $expectedJsonEncodedString);
    }


    public function testToArray(): void
    {
        $this->assertEquals(Fruits::toArray(), [
            'BANANA' => 1,
            'STRAWBERRY' => 2,
            'CHERRY' => 3,
            'WATERMELON' => 4,
            'ORANGE' => 5,
            'KIWI' => 6,
            'APPLE' => 7,
        ]);
    }

    public function testToArrayWithCustomMethod(): void
    {
        $this->assertEquals(Fruits::toArray('emojis'), [
            'BANANA' => '🍌',
            'STRAWBERRY' => '🍓',
            'CHERRY' => '🍒',
            'WATERMELON' => '🍉',
            'ORANGE' => '🍊',
            'KIWI' => '🥝',
            'APPLE' => '🍎',
        ]);
    }

    public function testToKeyValueCollection(): void
    {
        $expectedCollection = collect([
            'BANANA' => [
                'key' => 'BANANA',
                'value' => 1
            ],
            'STRAWBERRY' => [
                'key' => 'STRAWBERRY',
                'value' => 2
            ],
            'CHERRY' => [
                'key' => 'CHERRY',
                'value' => 3
            ],
            'WATERMELON' => [
                'key' => 'WATERMELON',
                'value' => 4
            ],
            'ORANGE' => [
                'key' => 'ORANGE',
                'value' => 5
            ],
            'KIWI' => [
                'key' => 'KIWI',
                'value' => 6
            ],
            'APPLE' => [
                'key' => 'APPLE',
                'value' => 7
            ],
        ]);

        $this->assertEquals(Fruits::toKeyValueCollection(), $expectedCollection);
    }

    public function testToKeyValueCollectionWithCustomMethod(): void
    {
        $expectedCollection = collect([
            'BANANA' => [
                'key' => 'BANANA',
                'value' => '🍌'
            ],
            'STRAWBERRY' => [
                'key' => 'STRAWBERRY',
                'value' => '🍓'
            ],
            'CHERRY' => [
                'key' => 'CHERRY',
                'value' => '🍒'
            ],
            'WATERMELON' => [
                'key' => 'WATERMELON',
                'value' => '🍉'
            ],
            'ORANGE' => [
                'key' => 'ORANGE',
                'value' => '🍊'
            ],
            'KIWI' => [
                'key' => 'KIWI',
                'value' => '🥝'
            ],
            'APPLE' => [
                'key' => 'APPLE',
                'value' => '🍎'
            ],
        ]);

        $this->assertEquals(Fruits::toKeyValueCollection('emojis'), $expectedCollection);
    }

    public function testToKeyValueCollectionWithCustomAttributes(): void
    {
        $expectedCollection = collect([
            'BANANA' => [
                'foo' => 'BANANA',
                'bar' => 1
            ],
            'STRAWBERRY' => [
                'foo' => 'STRAWBERRY',
                'bar' => 2
            ],
            'CHERRY' => [
                'foo' => 'CHERRY',
                'bar' => 3
            ],
            'WATERMELON' => [
                'foo' => 'WATERMELON',
                'bar' => 4
            ],
            'ORANGE' => [
                'foo' => 'ORANGE',
                'bar' => 5
            ],
            'KIWI' => [
                'foo' => 'KIWI',
                'bar' => 6
            ],
            'APPLE' => [
                'foo' => 'APPLE',
                'bar' => 7
            ],
        ]);

        $this->assertEquals(Fruits::toKeyValueCollection(keyAttributeName:'foo', valueAttributeName: 'bar'), $expectedCollection);
    }

    public function testToKeyValueCollectionWithCustomMethodAndCustomAttributes(): void
    {
        $expectedCollection = collect([
            'BANANA' => [
                'foo' => 'BANANA',
                'bar' => '🍌'
            ],
            'STRAWBERRY' => [
                'foo' => 'STRAWBERRY',
                'bar' => '🍓'
            ],
            'CHERRY' => [
                'foo' => 'CHERRY',
                'bar' => '🍒'
            ],
            'WATERMELON' => [
                'foo' => 'WATERMELON',
                'bar' => '🍉'
            ],
            'ORANGE' => [
                'foo' => 'ORANGE',
                'bar' => '🍊'
            ],
            'KIWI' => [
                'foo' => 'KIWI',
                'bar' => '🥝'
            ],
            'APPLE' => [
                'foo' => 'APPLE',
                'bar' => '🍎'
            ],
        ]);

        $this->assertEquals(Fruits::toKeyValueCollection('emojis','foo','bar'), $expectedCollection);
    }

    public function testToKeyValueArray(): void
    {
        $expectedArray = [
            [
                'key' => 'BANANA',
                'value' => 1
            ],
            [
                'key' => 'STRAWBERRY',
                'value' => 2
            ],
            [
                'key' => 'CHERRY',
                'value' => 3
            ],
            [
                'key' => 'WATERMELON',
                'value' => 4
            ],
            [
                'key' => 'ORANGE',
                'value' => 5
            ],
            [
                'key' => 'KIWI',
                'value' => 6
            ],
            [
                'key' => 'APPLE',
                'value' => 7
            ],
        ];

        $this->assertEquals(Fruits::toKeyValueArray(), $expectedArray);
    }

    public function testToKeyValueArrayWithCustomMethod(): void
    {
        $expectedArray = [
            [
                'key' => 'BANANA',
                'value' => '🍌'
            ],
            [
                'key' => 'STRAWBERRY',
                'value' => '🍓'
            ],
            [
                'key' => 'CHERRY',
                'value' => '🍒'
            ],
            [
                'key' => 'WATERMELON',
                'value' => '🍉'
            ],
            [
                'key' => 'ORANGE',
                'value' => '🍊'
            ],
            [
                'key' => 'KIWI',
                'value' => '🥝'
            ],
            [
                'key' => 'APPLE',
                'value' => '🍎'
            ],
        ];

        $this->assertEquals(Fruits::toKeyValueArray('emojis'), $expectedArray);
    }

    public function testToKeyValueArrayWithCustomAttribute(): void
    {
        $expectedArray = [
            [
                'foo' => 'BANANA',
                'bar' => 1
            ],
            [
                'foo' => 'STRAWBERRY',
                'bar' => 2
            ],
            [
                'foo' => 'CHERRY',
                'bar' => 3
            ],
            [
                'foo' => 'WATERMELON',
                'bar' => 4
            ],
            [
                'foo' => 'ORANGE',
                'bar' => 5
            ],
            [
                'foo' => 'KIWI',
                'bar' => 6
            ],
            [
                'foo' => 'APPLE',
                'bar' => 7
            ],
        ];

        $this->assertEquals(Fruits::toKeyValueArray(keyAttributeName:'foo', valueAttributeName: 'bar'), $expectedArray);
    }

    public function testToKeyValueArrayWithCustomMethodAndCustomAttributes(): void
    {
        $expectedArray = [
            [
                'foo' => 'BANANA',
                'bar' => '🍌'
            ],
            [
                'foo' => 'STRAWBERRY',
                'bar' => '🍓'
            ],
            [
                'foo' => 'CHERRY',
                'bar' => '🍒'
            ],
            [
                'foo' => 'WATERMELON',
                'bar' => '🍉'
            ],
            [
                'foo' => 'ORANGE',
                'bar' => '🍊'
            ],
            [
                'foo' => 'KIWI',
                'bar' => '🥝'
            ],
            [
                'foo' => 'APPLE',
                'bar' => '🍎'
            ],
        ];

        $this->assertEquals(Fruits::toKeyValueArray('emojis','foo','bar'), $expectedArray);
    }

    public function testRandomCase(): void
    {
        $this->assertContains(Fruits::randomCase(), ['BANANA', 'STRAWBERRY', 'CHERRY', 'WATERMELON', 'ORANGE', 'KIWI', 'APPLE']);
    }

    public function testCasesCollection(): void
    {
        $this->assertEquals(Fruits::casesCollection(), collect(['BANANA', 'STRAWBERRY', 'CHERRY', 'WATERMELON', 'ORANGE', 'KIWI', 'APPLE']));
    }

    public function testCasesArray(): void
    {
        $this->assertEquals(Fruits::casesArray(), ['BANANA', 'STRAWBERRY', 'CHERRY', 'WATERMELON', 'ORANGE', 'KIWI', 'APPLE']);
    }

    public function testAllToArray(): void
    {
        $this->assertEquals(Fruits::allToArray(), [
            "BANANA" => 1,
            "STRAWBERRY" => 2,
            "CHERRY" => 3,
            "WATERMELON" => 4,
            "ORANGE" => 5,
            "KIWI" => 6,
            "APPLE" => 7,
        ]);
    }

    public function testAllToArrayWithCustomMethod(): void
    {
        $this->assertEquals(Fruits::allToArray('emojis'), [
            "BANANA" => "🍌",
            "STRAWBERRY" => "🍓",
            "CHERRY" => "🍒",
            "WATERMELON" => "🍉",
            "ORANGE" => "🍊",
            "KIWI" => "🥝",
            "APPLE" => "🍎",
        ]);
    }


    public function testOnly(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = collect([
            "STRAWBERRY" => 2,
            "CHERRY" => 3,
            "WATERMELON" => 4,
        ]);

        $this->assertEquals(Fruits::only($cases),$expectedCollection);
    }

    public function testOnlyWithCustomMethod(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = collect([
            "STRAWBERRY" => '🍓',
            "CHERRY" => '🍒',
            "WATERMELON" => '🍉',
        ]);

        $this->assertEquals(Fruits::only($cases,'emojis'),$expectedCollection);
    }

    public function testOnlyAsArray(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = [
            "STRAWBERRY" => 2,
            "CHERRY" => 3,
            "WATERMELON" => 4,
        ];

        $this->assertEquals(Fruits::onlyAsArray($cases),$expectedCollection);
    }

    public function testOnlyAsArrayWithCustomMethod(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = [
            "STRAWBERRY" => '🍓',
            "CHERRY" => '🍒',
            "WATERMELON" => '🍉',
        ];

        $this->assertEquals(Fruits::onlyAsArray($cases,'emojis'),$expectedCollection);
    }

    public function testExcept(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = collect([
            "BANANA" => 1,
            "ORANGE" => 5,
            "KIWI" => 6,
            "APPLE" => 7,
        ]);

        $this->assertEquals(Fruits::except($cases),$expectedCollection);
    }

    public function testExceptWithCustomMethod(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = collect([
            "BANANA" => '🍌',
            "ORANGE" => '🍊',
            "KIWI" => '🥝',
            "APPLE" => '🍎',
        ]);

        $this->assertEquals(Fruits::except($cases,'emojis'),$expectedCollection);
    }

    public function testExceptAsArray(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = [
            "BANANA" => 1,
            "ORANGE" => 5,
            "KIWI" => 6,
            "APPLE" => 7,
        ];

        $this->assertEquals(Fruits::exceptAsArray($cases),$expectedCollection);
    }

    public function testExceptAsArrayWithCustomMethod(): void
    {
        $cases = ['CHERRY','STRAWBERRY','WATERMELON'];

        $expectedCollection = [
            "BANANA" => '🍌',
            "ORANGE" => '🍊',
            "KIWI" => '🥝',
            "APPLE" => '🍎',
        ];

        $this->assertEquals(Fruits::exceptAsArray($cases,'emojis'),$expectedCollection);
    }

    public function testFirst(): void
    {
        $this->assertEquals(Fruits::first(),1);
    }

    public function testFirstWithCustomMethod(): void
    {
        $this->assertEquals(Fruits::first('emojis'),'🍌');
    }

    public function testLastWithCustomMethod(): void
    {
        $this->assertEquals(Fruits::last('emojis'),'🍎');
    }

    public function testFromValueValid(): void
    {
        $this->assertEquals(Fruits::fromValue(1)->value, 1); 
    }

    public function testFromValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("The value '100' does not match any existing elements in the Enum.");
        Fruits::fromValue(100);
    }

    public function testValueNamePairsWithoutMethod(): void
    {
        $expected = collect([
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
        ]);
        $this->assertEquals(Fruits::valueNamePairs(), $expected);
    }

    public function testValueNamePairsWithMethod(): void
    {
        $expected = collect([
            1 => "🍌",
            2 => "🍓",
            3 => "🍒",
            4 => "🍉",
            5 => "🍊",
            6 => "🥝",
            7 => "🍎",
        ]);
        $this->assertEquals(Fruits::valueNamePairs('emojis'), $expected);
    }

    public function testValueNamePairsWithInvalidMethod(): void
    {
        $expected = collect([
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
        ]);
        $this->assertEquals(Fruits::valueNamePairs('invalidMethod'), $expected);
    }
}

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

    public function emojis(): string
    {
        return match ($this) {
            self::BANANA     => '🍌',
            self::STRAWBERRY => '🍓',
            self::CHERRY     => '🍒',
            self::WATERMELON => '🍉',
            self::ORANGE     => '🍊',
            self::KIWI       => '🥝',
            self::APPLE      => '🍎',
        };
    }
}
