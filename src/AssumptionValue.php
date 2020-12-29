<?php
/**
 * Created by PhpStorm.
 * User: Francesco
 * Date: 12/12/2014
 * Time: 14.24
 */

namespace WolframAlpha;

class AssumptionValue
{
    public $parsedXml;

    private $attributes = array();

    public function __construct($parsedAssumptionValueXml)
    {
        $this->parsedXml = $parsedAssumptionValueXml;

        foreach ($parsedAssumptionValueXml->attributes() as $key => $value) {
            $this->attributes[$key] = $value->__toString();
        }
    }

    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }
}
