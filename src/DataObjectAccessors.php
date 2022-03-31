<?php

namespace Traitor;

trait DataObjectAccessors
{
    /**
     * @var string[]
     */
    protected static $__accessorsCache = [];

    /**
     * Enable accessors for all properties.
     *
     * @param $method
     * @param $args
     * @return bool|null
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
            {
                $key = $this->__getKeyFromMethod(substr($method, 3));
                return $this->getData($key);
            }
            case 'set':
            {
                $key = $this->__getKeyFromMethod(substr($method, 3));
                $value = $args[0] ?? null;
                return $this->setData($key, $value);
            }
            case 'uns':
            {
                $key = $this->__getKeyFromMethod(substr($method, 3));
                return $this->unsetData($key);
            }
            case 'has':
            {
                $key = $this->__getKeyFromMethod(substr($method, 3));
                return $this->hasData($key);
            }
        }

        throw new \BadMethodCallException(sprintf('Method %s does not exist', $method));
    }

    /**
     * Transforms a method name to a key.
     *
     * @param string $name
     * @return string
     */
    protected function __getKeyFromMethod(string $name): string
    {
        if (isset(self::$__accessorsCache[$name])) {
            return self::$__accessorsCache[$name];
        }

        $result = strtolower(trim(preg_replace('/([A-Z]|[0-9]+)/', "_$1", $name), '_'));
        self::$__accessorsCache[$name] = $result;

        return $result;
    }
}
