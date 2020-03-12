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
    private $data = [];

    /**
     *  constructor.
     * @param array $data
     */
    public function __construct(iterable $data) {
        foreach ($data as $k => $v){
            $this->data[$k] = $v;
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name) {
        return $this->data[$name] ?? null ;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name) : bool {
        return array_key_exists($name, $this->data);
    }

    /**
     * @param $name
     */
    public function __unset($name) {
        unset($this->data[$name]);
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return $this->data;
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string {
        return json_encode($this->data, $options);
    }

    /**
     * @return \Traversable|void
     */
    public function getIterator() {
        return new \ArrayIterator($this->data);
    }
    
}
