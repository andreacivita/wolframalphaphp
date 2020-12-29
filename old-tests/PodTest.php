<?php

class PodTest extends PHPUnit_Framework_TestCase
{
    public $pod;

    public function prepare()
    {
        $parsedXml = new SimpleXMLElement(file_get_contents(dirname(__FILE__)."/xml/normal.xml"));
        $parsedPodXml = $parsedXml->xpath('pod')[0];

        $this->pod = new \WolframAlpha\Pod($parsedPodXml);
    }

    public function testPodCreation()
    {
        $this->prepare();

        $this->assertInstanceOf('WolframAlpha\\Pod', $this->pod);
    }

    public function testPodAttributes()
    {
        $this->prepare();

        $this->assertEquals('Input interpretation', $this->pod->title);
    }

    public function testPodSubpodsCount()
    {
        $this->prepare();

        $this->assertEquals(1, count($this->pod->subpods));
    }
}
