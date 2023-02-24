<?php

namespace Bermuda\DataObj;

use Bermuda\Arrayable;

/**
 * Class DataObj
 * @package Bermuda\DataObj
 */
final class DataObj implements Arrayable, \Stringable, \ArrayAccess, \IteratorAggregate
{
    /**
     * @var callable|null
     */
    private $generator = null;
    public readonly array $data;
    
    public function __construct(iterable $data = [])
    {
        foreach ($data as $k => $value) $this->data[$k] = $value;
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
    
    public function setIterator(?callable $setter): self
    {
        if ($setter) $this->generator = static function (array $data) use ($setter): \Generator {
            foreach ($setter($data) as $k => $value) yield $k => $value ;
        };
        else $this->generator = null;
        
        return $this;
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
     * @return mixed
     */
    public function set(string $name, mixed $value): mixed
    {
        return $this->data[$name] = $value;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, mixed $default = null): mixed
    {
        return $this->offsetExists($name) ? $this->data[$name] : $default ;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->offsetExists($name);
    }

    /**
     * @param string $name
     * @return void
     */
    public function remove(string $name): void
    {
        unset($this->data[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return $this->offsetExists($name);
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
        return $this->data;
    }

    /**
     * @param int $options
     * @throws \JsonException
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->data, $options|JSON_THROW_ON_ERROR);
    }

    /**
     * @return \Generator
     */
    public function getIterator(): \Generator
    {
        if (!$this->generator) foreach ($this->data as $k => $value) yield $k => $value ;
        else return ($this->generator)($this->data);
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet(mixed $offset): mixed
    {
        if ($this->offsetExists($offset)) return $this->data[$offset] = new self();
        return $this->data[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $offset === null ? $this->data[] = $value : $this->data[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }
}
