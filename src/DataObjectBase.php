<?php

namespace Traitor;

trait DataObjectBase
{
    /**
     * @var array
     */
    protected $__data = [];

    /**
     * @param array $arr
     * @return $this
     */
    public function addData(array $arr)
    {
        foreach ($arr as $index => $value) {
            $this->setData($index, $value);
        }

        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if ($key === (array)$key) {
            $this->__data = $key;
        } else {
            $this->__data[$key] = $value;
        }

        return $this;
    }

    /**
     * @param mixed $key
     * @return $this
     */
    public function unsetData($key = null)
    {
        if ($key === null) {
            $this->setData([]);
        } elseif (is_string($key)) {
            if (isset($this->__data[$key]) || array_key_exists($key, $this->__data)) {
                unset($this->__data[$key]);
            }
        } elseif ($key === (array)$key) {
            foreach ($key as $element) {
                $this->unsetData($element);
            }
        }

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getData(string $key = '')
    {
        if ('' === $key) {
            return $this->__data;
        }

        if (strpos($key, '/') !== false) {
            $data = $this->getDataByPath($key);
        } else {
            $data = $this->__data[$key] ?? null;
        }

        return $data;
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function getDataByPath(string $path)
    {
        $keys = explode('/', $path);
        $data = $this->__data;

        foreach ($keys as $key) {
            if ((array)$data === $data && isset($data[$key])) {
                $data = $data[$key];
            } else {
                return null;
            }
        }

        return $data;
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function hasData($key = ''): bool
    {
        if (empty($key) || !is_string($key)) {
            return !empty($this->__data);
        }

        return array_key_exists($key, $this->__data);
    }
}
