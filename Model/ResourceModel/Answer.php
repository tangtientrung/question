<?php
 
namespace AHT\Question\Model\ResourceModel;
 
class Answer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('answer', 'id');
    }
}