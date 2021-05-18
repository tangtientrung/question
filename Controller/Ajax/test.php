<?php
namespace AHT\Question\Controller\Ajax;

use Magento\Framework\Controller\ResultFactory;

class Test extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory   $resultJsonFactory
    ) {

        $this->resultJsonFactory            = $resultJsonFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) 
        {
            $test=Array
            (
                'Firstname' => 'What is your firstname',
                'Email' => 'What is your emailId',
                'Lastname' => 'What is your lastname',
                'Country' => 'Your Country'
            );
            return $result->setData($test);
        }
    }
}
?>