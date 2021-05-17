<?php
 
namespace AHT\Question\Model;
 
class Question extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Test's Statuses
     */
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    protected function _construct()
    {
        $this->_init('AHT\Question\Model\ResourceModel\Question');
    }

    /**
     * Prepare banner's statuses.
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_PENDING => __('Pending'), self::STATUS_APPROVED => __('Approved')];
    }
}