<?php
class BaseTest extends PHPUnit_Framework_TestCase
{
    private $console;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->console = \Wally\Console\Console::getInstance();
    }
    public function testBase()
    {
        $this->assertInstanceOf("\Wally\Console\Console", $this->console);
    }
    
    public function testColors()
    {
        $colors = $this->console->getAvailableColors();
        
        $this->assertTrue(in_array("red", $colors));
        $this->assertTrue(in_array("yellow", $colors));
        $this->assertTrue(in_array("blue", $colors));
        $this->assertTrue(in_array("green", $colors));
    }
    
    /**
     * @expectedException \Wally\Console\Exception 
     */
    public function testNotClone()
    {
        $n = clone $this->console;
    }
    
    /**
     * @expectedException \Wally\Console\Exception 
     */
    public function testColorNotSupported()
    {
        $this->console->cyanobluebutsimplewhite("hello");
    }
    
    public function testNotPosixMessage()
    {
        $stub = $this->getMock(
        	'\Wally\Console\Console', 
            array('_isPosix'),
            array(), 
        	'', 
            false
        );
        
        $stub->expects($this->any())
            ->method('_isPosix')
            ->will($this->returnValue(false));
        
        $stub->init();
        
        $this->assertEquals("walter", $stub->red("walter"));
    }
}