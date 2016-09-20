<?php

/**
 * Contains TableGeneratorConfig class
 */

namespace TableGenerator;

if (count(get_included_files()) === 1) {
    exit('Direct access is not permitted.');
}

/**
 * Class TableGeneratorConfig
 */
class TableGeneratorConfig
{
    /**
     * @var array
     */
    private $configs = [
        'sorterJSFunction' => 'sort',
        'checkAllByCheckboxJSFunction' => 'checkAllByCheckbox'
    ];

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public function getConfig($key)
    {
        if (array_key_exists($key, $this->configs)) {
            return $this->configs[$key];
        } else {
            throw new \Exception("config: {$key} does not exist");
        }
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
