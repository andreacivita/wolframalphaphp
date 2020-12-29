<?php

class PodsCollectionTest extends PHPUnit_Framework_TestCase
{
    public $podCollection;

    public function prepare()
    {
        $parsedXml = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/xml/multiple_pods.xml"));

        $this->podCollection = new \WolframAlpha\Collections\PodsCollection($parsedXml->xpath('pod'));
    }

    public function testPodsCollectionCreation()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Collections\\PodsCollection', $this->podCollection);
    }

    public function testPodsCollectionArrayBehavior()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Pod', $this->podCollection['Input']);
        $this->assertEquals(2, count($this->podCollection));
    }

    public function testPodsCollectionFindMethod()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Pod', $this->podCollection->find('Input'));
        $this->assertNull($this->podCollection->find('VisualData'));
    }

    public function testPodsCollectionHasMethod()
    {
        $this->prepare();

        $this->assertEquals(true, $this->podCollection->has('Input'));
        $this->assertEquals(false, $this->podCollection->has('VisualData'));
    }
}
