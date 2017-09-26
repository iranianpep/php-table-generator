<?php
/**
 * Contains Cell class.
 */

namespace TableGenerator;

/**
 * Class Cell.
 */
class Cell extends TableGenerator
{
    /**
     * cell content.
     *
     * @var string
     */
    public $content;

    /**
     * cell rowspan.
     *
     * @var
     */
    private $rowspan;

    /**
     * cell colspan.
     *
     * @var
     */
    private $colspan;

    /**
     * cell scope.
     *
     * @var
     */
    private $scope;

    /**
     * array of possible scope values.
     *
     * @var array
     */
    private $scopeWhiteList;

    /**
     * initialize a cell object.
     *
     * @param string $content
     * @param bool   $htmlspecialchars
     */
    public function __construct($content = '', $htmlspecialchars = false)
    {
        $content = $htmlspecialchars === true ? htmlspecialchars($content, ENT_QUOTES) : $content;
        $this->setContent($content);

        $this->scopeWhiteList = ['col', 'row', 'colgroup', 'rowgroup'];
    }

    /**
     * add rowspan to a cell.
     *
     * @param int $rowspan
     */
    public function addRowspan($rowspan)
    {
        try {
            $rowspan = (int) $rowspan;

            if (empty($rowspan)) {
                throw new TableException('rowspan must be numeric and greater than zero');
            }

            $this->rowspan = $rowspan;
        } catch (TableException $e) {
            $e->displayError();
        }
    }

    /**
     * add colspan to a cell.
     *
     * @param $colspan
     */
    public function addColspan($colspan)
    {
        try {
            $colspan = (int) $colspan;

            if (empty($colspan)) {
                throw new TableException('colspan must be numeric and greater than zero');
            }

            $this->colspan = $colspan;
        } catch (TableException $e) {
            $e->displayError();
        }
    }

    /**
     * add scope to a cell.
     *
     * scope can only be 'col', 'row', 'colgroup' or 'rowgroup'
     *
     * @param $scope
     */
    public function addScope($scope)
    {
        try {
            if (!in_array($scope, $this->scopeWhiteList)) {
                $scopeWhiteList = implode(', ', $this->scopeWhiteList);
                throw new TableException("scope in addScope() must be one of these values: {$scopeWhiteList}");
            }

            $this->scope = $scope;
        } catch (TableException $e) {
            $e->displayError();
        }
    }

    /**
     * return scope for a cell.
     *
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * return rowspan for a cell.
     *
     * @return int
     */
    public function getRowspan()
    {
        return $this->rowspan;
    }

    /**
     * return colspan for a cell.
     *
     * @return int
     */
    public function getColspan()
    {
        return $this->colspan;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Alias for getContent().
     */
    public function getHtml()
    {
        $this->getContent();
    }
}
