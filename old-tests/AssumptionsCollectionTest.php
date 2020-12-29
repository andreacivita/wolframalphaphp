<?php

class AssumptionsCollectionTest extends PHPUnit_Framework_TestCase
{
    public $assumptionsCollection;

    public function prepare()
    {
        $parsedXml = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/xml/assumptions.xml"));
        $this->assumptionsCollection = new \WolframAlpha\Collections\AssumptionsCollection($parsedXml->assumptions->assumption);
    }

    public function testAssumptionsCollectionCreation()
    {
        $this->prepare();
        $this->assertInstanceOf('WolframAlpha\\Collections\\AssumptionsCollection', $this->assumptionsCollection);
    }

    public function testAssumptionsCollectionArrayBehavior()
    {
        $this->prepare();

        $this->assertEquals(1, count($this->assumptionsCollection));
        $this->assertInstanceOf('WolframAlpha\\Assumption', $this->assumptionsCollection['Clash']);
    }

    public function testAssumptionsCollectionHasMethod()
    {
        $this->prepare();

        $this->assertEquals(true, $this->assumptionsCollection->has('Clash'));
        $this->assertEquals(false, $this->assumptionsCollection->has('MagalliAssumption'));
    }

    public function testAssumptionsCollectionFindMethod()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Assumption', $this->assumptionsCollection->find('Clash'));
        $this->assertNull($this->assumptionsCollection->find('MagalliAssumption'));
    }
}
