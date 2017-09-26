<?php
/**
 * Contains Table class.
 */

namespace TableGenerator;

/**
 * Class Table.
 */
class Table extends TableGenerator
{
    /**
     * table caption.
     *
     * @var Caption
     */
    private $caption;

    /**
     * table head.
     *
     * @var Head
     */
    private $head;

    /**
     * table body.
     *
     * @var Body
     */
    private $body;

    /**
     * table footer.
     *
     * @var Footer
     */
    private $footer;

    //\\//\\//\\//\\//\\ Beginning of Setters //\\//\\//\\//\\//\\

    /**
     * add caption to a table.
     *
     * @param Caption $caption
     */
    public function addCaption(Caption $caption)
    {
        $this->caption = $caption;
    }

    /**
     * add head to a table.
     *
     * @param Head $head
     */
    public function addHead(Head $head)
    {
        $this->head = $head;
    }

    /**
     * add body to a table.
     *
     * @param Body $body
     */
    public function addBody(Body $body)
    {
        $this->body = $body;
    }

    /**
     * add footer to a table.
     *
     * @param Footer $footer
     */
    public function addFooter(Footer $footer)
    {
        $this->footer = $footer;
    }

    //\\//\\//\\//\\//\\ End of Setters //\\//\\//\\//\\//\\

    //\\//\\//\\//\\//\\ Beginning of Getters //\\//\\//\\//\\//\\

    /**
     * get caption for a table.
     *
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * get head for a table.
     *
     * @return mixed
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * get body for a table.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * get footer for a table.
     *
     * @return mixed
     */
    public function getFooter()
    {
        return $this->footer;
    }

    //\\//\\//\\//\\//\\ End of Getters //\\//\\//\\//\\//\\

    //\\//\\//\\//\\//\\ Beginning of Utility //\\//\\//\\//\\//\\

    /**
     * get html for a table.
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        $html = "<table{$attributesHtml}>";

        // get caption
        $caption = $this->getCaption();

        // get caption html
        if ($caption !== '' && $caption instanceof Caption) {
            $html .= $caption->getHtml();
        }

        // get head
        $head = $this->getHead();

        // get head html
        if ($head !== '' && $head instanceof Head) {
            $html .= $head->getHtml();
        }

        // get footer
        $footer = $this->getFooter();

        // get footer html
        if ($footer !== '' && $footer instanceof Footer) {
            $html .= $footer->getHtml();
        }

        // get body
        $body = $this->getBody();

        // get body html
        if ($body !== '' && $body instanceof Body) {
            $html .= $body->getHtml();
        }

        $html .= '</table>';

        return $html;
    }

    /**
     * print table.
     */
    public function display()
    {
        echo $this->getHtml();
    }

    //\\//\\//\\//\\//\\ End of Utility //\\//\\//\\//\\//\\
}
