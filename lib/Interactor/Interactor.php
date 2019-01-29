<?php

namespace Lib\Interactor;

trait Interactor
{
    abstract function call();
    
    public function __invoke()
    {
        $arguments = func_get_args();
        $payload = [];

        if (method_exists($this, 'validate') && !$this->validate(...$arguments)) {
            return new InteractorResult($payload, false); 
        }

        static::call(...$arguments);
        foreach ((static::$expose ?? []) as $expose) {
            $payload[$expose] = $this->{$expose};
        }
        
        return new InteractorResult($payload, true);
    }
}
