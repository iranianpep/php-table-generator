<?php
/**
 * Contains Footer class.
 */

namespace TableGenerator;

if (count(get_included_files()) === 1) {
    exit('Direct access to not permitted.');
}

/**
 * Class Footer.
 */
class Footer extends TableGenerator
{
    /**
     * footer row.
     *
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
