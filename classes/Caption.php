<?php
/**
 * Contains Caption class
 */

/**
 * Class Caption
 */
class Caption extends TableGenerator
{
    /**
     * content
     *
     * @var string $content
     */
    public $content;

    /**
     * initialize a caption object
     *
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * return html for caption
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        $html = "<caption {$attributesHtml}>{$this->content}</caption>";

        return $html;
    }
}
