<?php

namespace Bermuda;

use Bermuda\Arrayable;

/**
 * Class DataObj
 * @package Bermuda\DataObj
 */
final class DataObj implements Arrayable, \Stringable, \ArrayAccess, \IteratorAggregate
{
    private array $data = [];
    public function __construct(object|iterable $data = [])
    {
        if (!is_iterable($data)) $this->data = get_object_vars($data);
        elseif (is_array($data)) $this->data = $data;
        else foreach ($data as $k => $value) $this->data[$k] = $value;
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, mixed $value): void
    {
        $this->set($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
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
        return $this->offsetExists($name) ? $this->offsetGet($name) : $default ;
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
        $this->offsetUnset($name);
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
    public function __unset(string $name): void 
    {
        $this->offsetUnset($name);
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
        foreach ($this->data as $k => $value) yield $k => $value ;
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet(mixed $offset): mixed
    {
        if (!$this->offsetExists($offset)) return $this->data[$offset] = new self();
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
