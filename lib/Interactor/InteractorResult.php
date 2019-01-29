<?php

namespace Lib\Interactor;

use \Exception;

class InteractorResult
{
    private $success = true;
    private $payload = [];
    
    public function __construct($payload, $success = true)
    {
        $this->payload = $payload; 
        $this->success = $success; 
    }

    public function successful()
    {
        return $this->success;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->payload)) {
            return $this->payload[$name];
        }

        $property = static::class . '::$' . $name;
        throw new Exception("Undefined property {$property}");
    }
}