<?php
namespace app\core;

class BaseModel
{
    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        $getter = 'get' . $name; //getuser
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new \Exception('Getting write-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new \Exception('Getting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
}