<?php
/**
* Contains TableGenerator class
*/

/**
 * Class TableGenerator
 */
abstract class TableGenerator
{
    /**
     * css class
     *
     * @var string $class
     */
    public $class;

    /**
     * css id
     *
     * @var string $id
     */
    public $id;

    /**
     * css styling
     *
     * @var string $style
     */
    public $style;

    /**
     * data
     *
     * @var array $data
     */
    private $data;

    /**
     * settings
     *
     * @var array $settings
     */
    public $settings;

    /**
     * initialize a TableGenerator object
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
     * add data to an element
     *
     * @param $key
     * @param $value
     */
    public function addData($key, $value)
    {
        $this->data[] = [$key, $value];
    }

    /**
     * get html for all the attributes assigned to a an element
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
     * get html for an attribute assigned to an element
     *
     * @param $attribute
     *
     * @return string
     */
    public function getAttributeHtml($attribute)
    {
        if (isset($this->$attribute) && $this->$attribute !== '') {
            switch ($attribute) {
                case 'data':
                    $allData = $this->getData();
                    $allDataAttributes = '';

                    foreach ($allData as $data) {
                        $allDataAttributes .= "data-{$data[0]}={$data[1]} ";
                    }

                    return $allDataAttributes;
                default:
                    return "{$attribute}='{$this->$attribute}'";
            }
        }
    }

    /**
     * get data from an element
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
