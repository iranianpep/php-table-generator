<?php
/**
 * Contains TableException class.
 */

namespace TableGenerator;

/**
 * Class TableException.
 */
class TableException extends \Exception
{
    /**
     * initialize a TableException object.
     *
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * print errors.
     */
    public function displayError()
    {
        echo '<span style="color: red;">Error: <b>'.$this->getMessage().'</b></span><br>';
        echo 'File: '.$this->getFile().'<br>';
        echo 'Line: '.$this->getLine().'<br>';
        echo 'Trace: '.$this->getTraceAsString().'<br><br>';
    }
}
