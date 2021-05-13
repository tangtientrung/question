<?php
 
namespace AHT\Question\Model\ResourceModel\Answer;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /*
    * @var $_idFieldName
    */
    protected $_idFieldName = 'id';
 
    protected function _construct()
    {
        $this->_init('AHT\Question\Model\Answer', 'AHT\Question\Model\ResourceModel\Answer');
    }
}