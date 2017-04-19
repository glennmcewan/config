<?php

namespace Glenn\Config\Test\Facade;

use PHPUnit_Framework_TestCase;

use ReflectionClass;

use Glenn\Config\Manager;
use Glenn\Config\Facade\AbstractFacade;

class AbstractFacadeTest extends PHPUnit_Framework_TestCase
{
    protected $sampleConfigData = [
        'author' => [
            'name'  => 'Glenn McEwan',
            'email' => 'glenn@web-dev.ninja',
        ],
        'deployment' => [
            'name'    => 'Client A',
            'version' => 2,
            'url'     => 'http://example.org',
            'legacy'  => false,
            'contacts' => [
                'Glenn McEwan <glenn@web-dev.ninja>',
                'Site Admin <example@example.org>',
            ],
        ],
    ];
    
    /**
     * Data provider to provide a fresh Config Manager with each test.
     */
    public function configProvider()
    {
        return [
            [
                new Manager($this->sampleConfigData)
            ]
        ];
    }

    /**
     * Test the Config Facade without a parent key.
     *
     * @dataProvider configProvider
     *
     * @param  Manager $config
     */
    public function testWithoutParentKey(Manager $config)
    {
        $facade = $this->getMockForAbstractClass(AbstractFacade::class, [$config]);

        $this->assertSame('Glenn McEwan', $facade->get('author.name'));

        $this->assertCount(2, $facade->get('deployment.contacts'));

        $this->assertSame('Glenn McEwan <glenn@web-dev.ninja>', $facade->get('deployment.contacts.0'));
    }

    /**
     * Test the Config Facade with a parent key.
     *
     * @dataProvider configProvider
     *
     * @param  Manager $config
     */
    public function testWithParentKey(Manager $config)
    {
        $facade = $this->getMockForAbstractClass(AbstractFacade::class, [$config]);

        $reflectionClass = new ReflectionClass($facade);
        $reflectionProp = $reflectionClass->getProperty('parentKey');
        $reflectionProp->setAccessible(true);
        $reflectionProp->setValue($facade, 'deployment');

        $this->assertNull($facade->get('author'));
        $this->assertSame('Client A', $facade->get('name'));
    }
}
