<?php

/**
 * Contains TableGeneratorConfig class.
 */

namespace TableGenerator;

/**
 * Class TableGeneratorConfig.
 */
class TableGeneratorConfig
{
    /**
     * @var array
     */
    private $configs = [
        'sorterJSFunction'             => 'sort',
        'checkAllByCheckboxJSFunction' => 'checkAllByCheckbox',
    ];

    /**
     * @param $key
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function getConfig($key)
    {
        if (!array_key_exists($key, $this->configs)) {
            throw new \Exception("config: {$key} does not exist");
        }

        return $this->configs[$key];
    }

    /**
     * @param $key
     * @param $value
     */
    public function setConfig($key, $value)
    {
        $this->configs[$key] = $value;
    }
}
