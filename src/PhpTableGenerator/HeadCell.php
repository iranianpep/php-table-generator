<?php
/**
 * Contains Head Cell class
 */

namespace TableGenerator;

if (count(get_included_files()) === 1) {
    exit('Direct access to not permitted.');
}

/**
 * Class Cell
 */
class HeadCell extends Cell
{
    /**
     * head cell title
     *
     * @var string $title
     */
    private $title;

    /**
     * head cell alias
     *
     * @var string $alias
     */
    private $alias;

    /**
     * @var boolean $sortable
     */
    private $sortable;

    /**
     * @var boolean $searchable
     */
    private $searchable;

    /**
     * @var boolean $selectable
     */
    private $selectable;

    /**
     * @var string $searchPattern
     */
    private $searchPattern;

    /**
     * @var
     */
    private $selectAllSelector;

    public function __construct($title = null, $alias = null, $content = null, $htmlspecialchars = false)
    {
        if ($title !== null) {
            $this->setTitle($title);
        }

        if ($alias !== null) {
            $this->setAlias($alias);
        }

        parent::__construct($content, $htmlspecialchars);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        // if alias is not set, consider lower case of the title as alias
        if (!isset($this->alias)) {
            return strtolower($this->getTitle());
        }

        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return boolean
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /**
     * @return string
     */
    public function getSearchPattern()
    {
        return $this->searchPattern;
    }

    /**
     * @param boolean $sortable
     */
    public function setSortable($sortable)
    {
        $this->sortable = $sortable;
    }

    /**
     * @return boolean
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * @param        $searchable
     * @param string $searchPattern Valid values: `q`, `*q`, `q*`, `*q*`
     *
     * @throws \Exception
     */
    public function setSearchable($searchable, $searchPattern = 'q')
    {
        $this->searchable = $searchable;

        if (!in_array($searchPattern, ['q', '*q', 'q*', '*q*'])) {
            throw new \Exception("'{$searchPattern}' is not a valid search pattern");
        }

        $this->searchPattern = $searchPattern;
    }

    /**
     * @return boolean
     */
    public function isSelectable()
    {
        return $this->selectable;
    }

    /**
     * @param $selectable
     * @param $selectAllSelector
     */
    public function setSelectable($selectable, $selectAllSelector = '')
    {
        $this->selectable = $selectable;
        $this->selectAllSelector = $selectAllSelector;
    }

    /**
     * According the current sorting direction, alias, and etc return
     * the next sorting direction
     *
     * @return string
     */
    public function getSortDir()
    {
        $alias = $this->getAlias();
        $listSortBy = $this->getListSortBy();
        $listSortDir = $this->getListSortDir();

        return ($alias ===  $listSortBy && $listSortDir === 'asc') ? 'desc' : 'asc';
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getContent()
    {
        // if content is not null return the content
        if ($this->content !== null) {
            return $this->content;
        }

        $config = new TableGeneratorConfig();
        $checkAllFunction = $config->getConfig('checkAllByCheckboxJSFunction');

        $title = $this->getTitle();

        $checkboxHtml = $this->isSelectable() === true ?
            "<input type='checkbox' onclick=\"{$checkAllFunction}(this, '{$this->selectAllSelector}');\">" : '';

        // if head cell is not sortable only return title as the content
        if ($this->isSortable() === false) {
            return $checkboxHtml . ' ' . $title;
        }

        $alias = $this->getAlias();
        $listSortByKey = $this->getListSortByKey();
        
        $sortDir = $this->getSortDir();

        $sortFunction = $config->getConfig('sorterJSFunction');
        $listSortDirKey = $this->getListSortDirKey();

        return "{$checkboxHtml} <a style='cursor: pointer;' onclick='{$sortFunction}(\"{$listSortByKey}\", \"{$alias}\", \"{$listSortDirKey}\", \"{$sortDir}\");'>{$title}</a>";
    }
}
