<?php


namespace Lobster;


use Lobster\Reducible\Arrayble;
use Lobster\Reducible\Jsonable;


/**
 * Class SimpleObject
 * @package Lobster
 */
class SimpleObject implements Arrayble, Jsonable, \IteratorAggregate 
{
    private array $attributes = [];

    /**
     * SimpleObject constructor
     * @param iterable $attributes
     */
    public function __construct(iterable $attributes = [])
    {
        foreach ($attributes as $name => $value)
        {
            $this->attributes[$name] = $value;
        }
    }
    
    /**
     * @return string
     * @throws \JsonException
     */
    public function __toString() : string 
    {
        return $this->toJson();
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->get($name);
    }
    
    /**
     * @param string $name
     * @param mixed $value
     * @return mixed|null
     */
    public function set(string $name, $value)
    {
        return $this->attributes[$name] = $value;
    }
    
     /**
     * @param string $name
     * @param mixed $default
     * @return mixed|null
     */
    public function get(string $name, $default = null)
    {
        return $this->attributes[$name] ?? $default ;
    }
    
    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name) : bool 
    {
        return array_key_exists($name, $this->attributes);
    }
    
    /**
     * @param string $name
     * @return bool
     */
    public function remove(string $name) : void
    {
        unset($this->attributes[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name) : bool 
    {
        return $this->has($name);
    }

    /**
     * @param string $name
     */
    public function __unset(string $name)
    {
        $this->remove($name);
    }

    /**
     * @return array
     */
    public function toArray(): array 
    {
        return $this->attributes;
    }

    /**
     * @param int $options
     * @throws \JsonException
     * @return string
     */
    public function toJson(int $options = 0): string 
    {
        return json_encode($this->attributes, $options|JSON_THROW_ON_ERROR);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator() : \ArrayIterator 
    {
        return new \ArrayIterator($this->attributes);
    }
}
