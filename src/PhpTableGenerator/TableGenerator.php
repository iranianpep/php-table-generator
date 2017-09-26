<?php

/**
 * Contains TableGenerator class.
 */

namespace TableGenerator;

/**
 * Class TableGenerator.
 */
abstract class TableGenerator
{
    /**
     * css class.
     *
     * @var string
     */
    public $class;

    /**
     * css id.
     *
     * @var string
     */
    public $id;

    /**
     * css styling.
     *
     * @var string
     */
    public $style;

    /**
     * data.
     *
     * @var array
     */
    private $data;

    /**
     * initialize a TableGenerator object.
     *
     * @param string $class
     * @param string $id
     * @param string $style
     */
    public function __construct($class = '', $id = '', $style = '')
    {
        $this->class = $class;
        $this->id = $id;
        $this->style = $style;
    }

    /**
     * add data to an element.
     *
     * @param $key
     * @param $value
     */
    public function addData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * get data from an element.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * get html for an attribute assigned to an element.
     *
     * @param $attribute
     *
     * @return string
     */
    public function getAttributeHtml($attribute)
    {
        if (empty($this->$attribute)) {
            return '';
        }

        switch ($attribute) {
            case 'data':
                $allData = $this->getData();
                $allDataAttributes = '';

                if (!empty($allData)) {
                    foreach ($allData as $key => $data) {
                        $allDataAttributes .= " data-{$key}={$data}";
                    }
                }

                return $allDataAttributes;
                break;
            default:
                return " {$attribute}='{$this->$attribute}'";
                break;
        }
    }

    /**
     * get html for all the attributes assigned to a an element.
     *
     * @return string
     */
    public function getAllAttributesHtml()
    {
        $attributes = ['class', 'id', 'style', 'data'];

        $allAttributesHtml = '';
        foreach ($attributes as $attribute) {
            $allAttributesHtml .= $this->getAttributeHtml($attribute);
        }

        return $allAttributesHtml;
    }

    /**
     * @return string
     */
    abstract public function getHtml();
}
