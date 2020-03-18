<?php


namespace Lobster;


use Lobster\Reducible\Arrayble;
use Lobster\Reducible\Jsonable;


/**
 * Class SimpleObject
 * @package Lobster
 */
class SimpleObject implements Arrayble, Jsonable, \IteratorAggregate {
    
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * SimpleObject constructor
     * @param iterable $attributes
     */
    public function __construct(iterable $attributes) {
        foreach ($attributes as $attr => $value){
            $this->attributes[$attr] = $value;
        }
    }
    
    /**
     * @return string
     * @throws \JsonException
     */
    public function __toString() : string {
        return $this->toJson(JSON_THROW_ON_ERROR);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name) {
        return $this->attributes[$name] ?? null ;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name) : bool {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * @param $name
     */
    public function __unset($name) {
        unset($this->attributes[$name]);
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return $this->attributes;
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string {
        return json_encode($this->attributes, $options);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator() : \ArrayIterator {
        return new \ArrayIterator($this->attributes);
    }
    
}
