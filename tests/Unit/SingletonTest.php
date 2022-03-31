<?php

use PHPUnit\Framework\TestCase;
use Traitor\DataObject;
use Traitor\Tests\Fixtures\SingletonFixture;

class SingletonTest extends TestCase
{
    /**
     * @covers DataObject::getData
     * @return void
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf(SingletonFixture::class, SingletonFixture::getInstance());
        $this->assertEquals('value', SingletonFixture::getInstance()->getValue());
    }
}
