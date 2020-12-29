<?php

class ValidateQueryResultTest extends PHPUnit_Framework_TestCase
{
    public $result;

    public function testValidateQueryResultCreation()
    {
        $this->prepare('validate_query');

        $this->assertInstanceOf('WolframAlpha\\ValidateQueryResult', $this->result);
    }

    public function testValidateQueryResultAssumptions()
    {
        $this->prepare('validate_query');

        $this->assertEquals(1, count($this->result->assumptions));
        $this->assertEquals(4, count($this->result->assumptions['Clash']->values));
    }

    public function testValidateQueryResultWithErrors()
    {
        $this->prepare('validate_query_error');

        $this->assertEquals(true, $this->result->hasError());
        $this->assertInternalType('array', $this->result->getError());
    }

    public function testValidateQueryResultWithWarnings()
    {
        $this->prepare('validate_query');

        $this->assertEquals(true, $this->result->hasWarnings());
        $this->assertInternalType('array', $this->result->getWarnings());
    }

    public function prepare($type)
    {
        switch ($type) {
            case 'validate_query':
                $xml = file_get_contents(dirname(__FILE__)."/xml/validate_query.xml");
                break;

            case 'validate_query_error':
                $xml = file_get_contents(dirname(__FILE__)."/xml/validate_query_error.xml");
                break;
        }

        $this->result = new \WolframAlpha\ValidateQueryResult($xml);
    }
}
