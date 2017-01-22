<?php

namespace Glenn\Config\Test;

use PHPUnit_Framework_TestCase;

use Glenn\Config\Manager;

class ManagerTest extends PHPUnit_Framework_TestCase
{
    protected $sampleConfigData = [
        'name'       => 'Glenn',
        'age'        => 18,
        'favourites' => [
            'food'   => 'pizza',
            'drink'  => 'coke',
            'colour' => 'black',
        ],
    ];

    /**
     * Test the @has method.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testHasMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $this->assertTrue($config->has('name'));
    }

    /**
     * Test the has method works successfully for nested querying.
     * Checking if sub-level nodes in the config exist using dot notation.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testNestedHasMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $this->assertTrue($config->has('favourites.food'));
        $this->assertTrue($config->has('favourites.drink'));
        $this->assertTrue($config->has('favourites.colour'));
        $this->assertFalse($config->has('favourites.dog'));
        $this->assertFalse($config->has('wrong.name'));
    }

    /**
     * Test the @get method.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testGetMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $this->assertEquals($config->get('name'), 'Glenn');
        $this->assertSame($config->get('age'), 18);
        $this->assertNotSame($config->get('age'), '18');
    }

    /**
     * Test the @set method.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testSetMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $config->set('gender', 'male');

        $this->assertTrue($config->has('gender'));
        $this->assertSame($config->get('gender'), 'male');

        $config->set('gender', 'female');

        $this->assertSame($config->get('gender'), 'female');
    }

    /**
     * Test the @get method works properly when passing a default.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testGetDefaultMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $this->assertEquals($config->get('gender', 'male'), 'male');
        $this->assertEquals($config->get('gender', 'female'), 'female');
        $this->assertNull($config->get('gender'));
    }

    /**
     * Test the @all method.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testAllMethod()
    {
        $sampleData = $this->sampleConfigData;

        $config = new Manager($sampleData);

        $this->assertSame($config->all(), $sampleData);

        $sampleData['gender'] = 'male';

        $config->set('gender', 'male');

        $this->assertSame($config->all(), $sampleData);
    }

    /**
     * Test the @set method sets a config entry,
     * and is retrievable with @get.
     *
     * @get with a default parameter should still return null if the
     * original @set call had a null value.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testSetNullMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $config->set('gender');

        $this->assertTrue($config->has('gender'));
        $this->assertNull($config->get('gender'));
        $this->assertNull($config->get('gender', 'male'));

        $config->set('gender', '');

        $this->assertSame($config->get('gender'), '');

        $config->set('gender', 'female');

        $this->assertSame($config->get('gender'), 'female');
    }

    /**
     * Test the set array method.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testSetArrayMethod()
    {
        $config = new Manager($this->sampleConfigData);

        $config->set(
            'languages',
            [
                'first' => 'English',
                'second' => 'Spanish',
            ]
        );

        $config->setArray([
            'languages' => [
                'third' => 'French',
            ],
        ]);

        $this->assertSame(
            $config->get('languages'),
            [
                'third' => 'French',
            ]
        );
    }

    /**
     * Test the set array method with a key passed in as a second parameter.
     *
     * @author Glenn McEwan <glenn@web-dev.ninja>
     */
    public function testSetArrayMethodWithKey()
    {
        $config = new Manager($this->sampleConfigData);

        $config->set(
            'languages',
            [
                'first' => 'English',
                'second' => 'Spanish',
            ]
        );

        $config->setArray(
            [
                'third' => 'French',
            ],
            'languages'
        );

        $this->assertSame(
            $config->get('languages'),
            [
                'third' => 'French',
            ]
        );
    }
}
