<?php
namespace AHT\Question\Controller\Ajax;

use Magento\Framework\Controller\ResultFactory;

class SaveEdit extends \Magento\Framework\App\Action\Action
{
    protected $json;
    protected $resultJsonFactory;
    protected $_questionFactory;
    protected $_customerSession;


    public function __construct(
		\Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Customer\Model\Session $customerSession,
        \AHT\Question\Model\QuestionFactory $questionFactory
		)
	{
        $this->_questionFactory = $questionFactory;
        $this->json = $json;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_customerSession = $customerSession;
		return parent::__construct($context);
	}
    public function execute()
    {
        //create new questionFactory
        $question = $this->_questionFactory->create();

        $id=$this->getRequest()->getParam('id');
        $question->load($id);
        $question->setContent($this->getRequest()->getParam('content'));
        $question->save();
    } 
}
 