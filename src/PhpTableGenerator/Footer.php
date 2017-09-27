<?php
/**
 * Contains Footer class.
 */

namespace TableGenerator;

class Footer extends TableGenerator
{
    /**
     * @var Row
     */
    private $row;

    /**
     * initialize a footer object.
     *
     * @param Row $row
     */
    public function __construct(Row $row = null)
    {
        $this->addRow($row);
    }

    /**
     * add row to a footer.
     *
     * @param Row $row
     */
    public function addRow(Row $row)
    {
        $this->row = $row;
    }

    /**
     * return row for a footer.
     *
     * @return Row
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * return html for a footer.
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        $html = "<tfoot{$attributesHtml}>";

        // get row
        $row = $this->row;

        if ($row !== '' && $row instanceof Row) {
            $html .= $row->getHtml();
        }

        $html .= '</tfoot>';

        return $html;
    }
}
