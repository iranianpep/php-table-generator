<?php

/**
 * Contains TableGenerator class
 */

namespace TableGenerator;

if (count(get_included_files()) === 1) {
    exit('Direct access is not permitted.');
}

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
     * @var
     */
    private $listSortByKey;

    /**
     * @var
     */
    private $listSortBy;

    /**
     * @var
     */
    private $listSortDirKey;

    /**
     * @var
     */
    private $listSortDir;

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
     * @param array $data
     */
    public function addData(array $data)
    {
        $this->data[] = $data;
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

                    if (!empty($allData)) {
                        foreach ($allData as $data) {
                            if (isset($data[0]) && $data[1]) {
                                $allDataAttributes .= " data-{$data[0]}={$data[1]}";
                            }
                        }
                    }

                    return $allDataAttributes;
                default:
                    return " {$attribute}='{$this->$attribute}'";
            }
        } else {
            return '';
        }
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
     * @return string
     */
    abstract public function getHtml();

    /**
     * @return string
     */
    public function getListSortByKey()
    {
        return $this->listSortByKey;
    }

    /**
     * @param string $listSortByKey
     */
    public function setListSortByKey($listSortByKey)
    {
        $this->listSortByKey = $listSortByKey;
    }

    /**
     * @return string
     */
    public function getListSortBy()
    {
        return $this->listSortBy;
    }

    /**
     * @param string $listSortBy
     */
    public function setListSortBy($listSortBy)
    {
        $this->listSortBy = $listSortBy;
    }

    /**
     * @return string
     */
    public function getListSortDirKey()
    {
        return $this->listSortDirKey;
    }

    /**
     * @param string $listSortDirKey
     */
    public function setListSortDirKey($listSortDirKey)
    {
        $this->listSortDirKey = $listSortDirKey;
    }

    /**
     * @return string
     */
    public function getListSortDir()
    {
        return $this->listSortDir;
    }

    /**
     * @param $listSortDir
     */
    public function setListSortDir($listSortDir)
    {
        $this->listSortDir = (strtolower($listSortDir) === 'asc') ? 'asc' : 'desc';
    }
}
