<?php

use PHPUnit\Framework\TestCase;
use Traitor\DataObject;
use Traitor\Tests\Fixtures\DataObjectFixture;

class DataObjectTest extends TestCase
{
    /**
     * @covers DataObject::getData
     * @return void
     */
    public function testGetData()
    {
        $fixture = new DataObjectFixture();
        $this->assertEquals([], $fixture->getData());
        $this->assertEquals(null, $fixture->getData('something'));
    }

    /**
     * @covers DataObject::setData
     * @return void
     */
    public function testSetData()
    {
        $fixture = new DataObjectFixture();

        $fixture->setData(['foo' => 'bar']);
        $this->assertEquals('bar', $fixture->getData('foo'));
    }

    /**
     * @covers DataObject::addData
     * @return void
     */
    public function testAddData()
    {
        $fixture = new DataObjectFixture();

        $fixture->addData(['foo' => 'bar']);
        $this->assertEquals('bar', $fixture->getData('foo'));

        $fixture->addData(['foo' => 'bar2']);
        $this->assertEquals('bar2', $fixture->getData('foo'));

        $fixture->addData(['ping' => 'pong']);
        $this->assertEquals('pong', $fixture->getData('ping'));
    }

    /**
     * @covers DataObject::hasData
     * @return void
     */
    public function testHasData()
    {
        $fixture = new DataObjectFixture();

        $fixture->setData(['foo' => 'bar']);
        $this->assertTrue($fixture->hasData('foo'));
        $this->assertFalse($fixture->hasData('bar'));
    }

    /**
     * @covers DataObject::unsetData
     * @return void
     */
    public function testUnsetData()
    {
        $fixture = new DataObjectFixture();

        $fixture->setData(['foo' => 'bar']);
        $this->assertTrue($fixture->hasData('foo'));

        $fixture->unsetData('foo');
        $this->assertFalse($fixture->hasData('foo'));
    }
}
