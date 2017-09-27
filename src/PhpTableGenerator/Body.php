<?php
/**
 * Contains Body class.
 */

namespace TableGenerator;

/**
 * Class Body.
 */
class Body extends TableGenerator
{
    /**
     * array of rows.
     *
     * @var array
     */
    private $rows;

    /**
     * initialize a body object.
     *
     * @param array $rows
     */
    public function __construct(array $rows = [])
    {
        $this->addRows($rows);
    }

    /**
     * add rows to body.
     *
     * @param array $rows
     */
    public function addRows(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * add row to body.
     *
     * by default, row is added to the end of body. The position can be specified using index starting from 0
     *
     * @param Row $row
     * @param int $index
     */
    public function addRow(Row $row, $index = -1)
    {
        try {
            if (!is_numeric($index)) {
                throw new TableException('index in addRow() must be numeric');
            }

            if (!$row instanceof Row) {
                throw new TableException('invalid row');
            }

            $rows = $this->rows;

            if ($index === -1) {
                // add to the end of the rows array
                $rows[] = $row;
            } else {
                // insert the item in
                array_splice($rows, $index, 0, [$row]);
            }

            $this->rows = $rows;
        } catch (TableException $e) {
            $e->displayError();
        }
    }

    /**
     * return rows for body.
     *
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * return html for body.
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        $html = "<tbody{$attributesHtml}>";

        // get rows
        $rows = $this->rows;

        foreach ($rows as $row) {
            if ($row !== '' && $row instanceof Row) {
                $html .= $row->getHtml();
            }
        }

        $html .= '</tbody>';

        return $html;
    }
}
