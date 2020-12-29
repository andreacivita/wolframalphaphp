<?php

namespace WolframAlpha;

class Pod
{
    public $parsedXml;
    public $subpods = array();

    private $attributes = array();

    public function __construct($podParsedXml)
    {
        $this->parsedXml = $podParsedXml;

        foreach ($podParsedXml->attributes() as $key => $value) {
            $this->attributes[$key] = $value->__toString();
        }

        foreach ($podParsedXml->subpod as $subpodParsedXml) {
            $this->subpods[] = new Subpod($subpodParsedXml);
        }
    }

    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }
}
