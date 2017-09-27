<?php
/**
 * Contains Row class.
 */

namespace TableGenerator;

/**
 * Class Row.
 */
class Row extends TableGenerator
{
    /**
     * array of row cells.
     *
     * @var array
     */
    private $cells;

    /**
     * initialize a row object.
     *
     * @param array $cells
     */
    public function __construct(array $cells = [])
    {
        $this->addCells($cells);
    }

    /**
     * add cells to a row.
     *
     * @param array $cells
     */
    public function addCells(array $cells)
    {
        $this->cells = $cells;
    }

    /**
     * add a cell to a row.
     *
     * by default, cell is added to the end of row. The position can be specified using index starting from 0
     *
     * @param Cell $cell
     * @param int  $index
     */
    public function addCell(Cell $cell, $index = -1)
    {
        try {
            if (!is_numeric($index)) {
                throw new TableException('index in addCell() must be numeric');
            }

            if (!$cell instanceof Cell) {
                throw new TableException('invalid cell');
            }

            $cells = $this->cells;

            if ($index === -1) {
                // add to the end of the rows array
                $cells[] = $cell;
            } else {
                // insert the item in
                array_splice($cells, $index, 0, [$cell]);
            }

            $this->cells = $cells;
        } catch (TableException $e) {
            $e->displayError();
        }
    }

    /**
     * return cells for a row.
     *
     * @return mixed
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * return html for a row.
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        $html = "<tr{$attributesHtml}>";

        // get cells
        $cells = $this->cells;

        if (!empty($cells)) {
            foreach ($cells as $cell) {
                if (!$cell instanceof Cell) {
                    continue;
                }

                // specify start and end tag based on cell type
                $htmlTag = $cell instanceof HeadCell ? 'th' : 'td';

                // get rowspan
                $rowspan = $cell->getRowspan();
                $rowspanHtml = isset($rowspan) ? " rowspan = \"{$rowspan}\"" : '';

                // get colspan
                $colspan = $cell->getColspan();
                $colspanHtml = isset($colspan) ? " colspan = \"{$colspan}\"" : '';

                $attributesHtml = $cell->getAllAttributesHtml();

                // get scope
                $scope = $cell->getScope();
                $scopeHtml = isset($scope) ? " scope = \"{$scope}\"" : '';

                // get cell content
                $content = $cell->getContent();

                $html .= "<{$htmlTag}{$rowspanHtml}{$colspanHtml}{$attributesHtml}{$scopeHtml}>{$content}</{$htmlTag}>";
            }
        }

        $html .= '</tr>';

        return $html;
    }
}
