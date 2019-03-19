<?php

namespace App\Http\Helper\DataFormatter;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class AbstractDataFormatter
 *
 * @package app\Http\Helpers\DataFormatter
 */
abstract class AbstractDataFormatter implements \JsonSerializable, Arrayable
{
    /**
     * @var mixed
     */
    protected $object;

    /**
     * @var array
     */
    protected $formatted_data = [];

    /**
     * AbstractDataFormatter constructor.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object = $object;
        $this->formatted_data = $this->setFormattedData();
    }

    /**
     * Get a value from formatted data by given key. If key is null, it returns all formatted data
     *
     * @param null $key
     * @param string $default
     * @return array|mixed|string
     */
    public function get($key = null, $default = '')
    {
        return ($key != null)
            ? (isset($this->formatted_data[$key])
                ? $this->formatted_data[$key]
                : $default
            )
            : $this->formatted_data;
    }

    /**
     * Set value to formatted data.
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->formatted_data[$key] = $value;
    }

    /**
     * Magic method to access to the object properties
     *
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return isset($this->object->$name) ? $this->object->$name : $this->get($name, null);
    }

    /**
     * run when writing data to inaccessible members.
     *
     * @param $name string
     * @param $value mixed
     * @return void
     */
    function __set($name, $value)
    {
        $this->object->$name = $value;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Return the data as json format
     */
    public function __toString()
    {
        return json_encode($this);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->formatted_data;
    }

    /**
     * Set formatted data from object
     *
     * @return array
     */
    protected abstract function setFormattedData();
}
