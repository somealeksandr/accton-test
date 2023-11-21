<?php

namespace App\DTO;

use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Class BaseDTO
 *
 * To transfer structured data to the service
 *
 * Request -> Controller -> Service -> Handler
 */
abstract class BaseDTO
{

    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        $properties = $class->getProperties();
        foreach ($properties as $reflectionProperty){
            $property = $reflectionProperty->getName();

            try {
                $this->{$property} = $parameters[$property] ?? null;
            }  catch (\TypeError $exception) {
                $this->{$property} = $class->getDefaultProperties()[$property];
            }
        }
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public static function fromArray(array $data)
    {
        return new static($data);
    }

    public function toArray(): array
    {
        $vars = get_object_vars($this);
        foreach ($vars as $name => $value) {
            $methodName = 'get' . Str::camel($name);
            if (method_exists($this, $methodName)) {
                $vars[$name] = $this->{$methodName}();
            }
        }

        return $vars;
    }
}

