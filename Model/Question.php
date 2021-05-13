<?php
 
namespace AHT\Question\Model;
 
class Question extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('AHT\Question\Model\ResourceModel\Question');
    }
}