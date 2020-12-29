<?php

class AssumptionTest extends PHPUnit_Framework_TestCase
{
    public $assumption;

    public function prepare()
    {
        $parsedXml = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/xml/assumptions_fragment.xml"));
        $this->assumption = new \WolframAlpha\Assumption($parsedXml->xpath('assumption')[0]);
    }

    public function testCreateAssumption()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Assumption', $this->assumption);
    }

    public function testAssumptionTypeIsCorrect()
    {
        $this->prepare();

        $this->assertEquals('Clash', $this->assumption->type);
    }

    public function testAssumptionValuesCountIsCorrect()
    {
        $this->prepare();

        $this->assertEquals(8, count($this->assumption->values));
    }

    public function testAssumptionValuesGetByIndex()
    {
        $this->prepare();

        $this->assertEquals('a character', $this->assumption->values['Character']->desc);
    }
}
