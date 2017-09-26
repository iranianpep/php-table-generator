<?php
/**
 * Contains Caption class.
 */

namespace TableGenerator;

/**
 * Class Caption.
 */
class Caption extends TableGenerator
{
    /**
     * content.
     *
     * @var string
     */
    public $content;

    /**
     * initialize a caption object.
     *
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * return html for caption.
     *
     * @return string
     */
    public function getHtml()
    {
        $attributesHtml = $this->getAllAttributesHtml();

        return "<caption{$attributesHtml}>{$this->content}</caption>";
    }
}
