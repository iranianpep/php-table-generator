<?php
/**
 * Contains Head class.
 */

namespace TableGenerator;

class Head extends TableGenerator
{
    /**
     * @var Row
     */
    private $row;

    /**
     * initialize a head object.
     *
     * @param Row $row
     */
    public function __construct(Row $row = null)
    {
        $this->addRow($row);
    }

    /**
     * add row to a head.
     *
     * @param Row $row
     */
    public function addRow(Row $row)
    {
        $this->row = $row;
    }

    /**
     * return row for a head.
     *
     * @return Row
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * return html for a head.
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        $html = "<thead{$attributesHtml}>";

        // get row
        $row = $this->row;

        if ($row !== '' && $row instanceof Row) {
            $html .= $row->getHtml();
        }

        $html .= '</thead>';

        return $html;
    }
}
