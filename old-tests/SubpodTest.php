<?php

class SubpodTest extends PHPUnit_Framework_TestCase
{
    public $subpod;

    public function prepare()
    {
        $parsedXml = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/xml/normal.xml"));
        $this->subpod = new WolframAlpha\Subpod($parsedXml->pod[0]->subpod);
    }

    public function testSubpodCreation()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Subpod', $this->subpod);
    }

    public function testSubpodElementGet()
    {
        $this->prepare();

        $this->assertEquals('test  (English word)', $this->subpod->plaintext);
        $this->assertInstanceOf('WolframAlpha\\Image', $this->subpod->img);
        $this->assertEquals(128, $this->subpod->img->width);
    }

    public function testSubpodElementNotFound()
    {
        $this->prepare();

        $this->assertNull($this->subpod->idontexsist);
    }
}
