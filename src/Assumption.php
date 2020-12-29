<?php

namespace WolframAlpha;

class Assumption
{
    public $parsedXml;

    private $attributes = array();

    public $values = array();

    public function __construct($assumptionParsedXml)
    {
        $this->parsedXml = $assumptionParsedXml;

        foreach ($assumptionParsedXml->attributes() as $key => $value) {
            $this->attributes[$key] = $value->__toString();
        }

        foreach ($assumptionParsedXml->xpath('value') as $value) {
            $this->values[$value->attributes()['name']->__toString()] = new AssumptionValue($value);
        }
    }

    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }
}
