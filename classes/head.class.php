<?php
    /**
     * Contains Head class
     */

    if (count(get_included_files()) === 1)
        exit('Direct access to ' . __FILE__ . ' not permitted.');

    /**
     * Class Head
     */
    class Head extends TableGenerator
    {
        /**
         * head row
         *
         * @var Row $row
         */
        private $row;

        /**
         * initialize a head object
         *
         * @param Row $row
         */
        public function __construct(Row $row = null)
        {
            $this->addRow($row);
        }

        /**
         * add row to a head
         *
         * @param Row $row
         */
        public function addRow(Row $row)
        {
            $this->row = $row;
        }

        /**
         * return row for a head
         *
         * @return mixed
         */
        public function getRow()
        {
            return $this->row;
        }

        /**
         * return html for a head
         *
         * @return string
         */
        public function getHtml()
        {
            $attributesHtml = $this->getAllAttributesHtml();

            $html = "<thead {$attributesHtml}>";

            // get row
            $row = $this->row;

            if ($row !== '' && ($row instanceof Row)) {
                $html .= $row->getHtml('head');
            }

            $html .= '</thead>';

            return $html;
        }

    }