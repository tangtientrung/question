<?php

namespace AHT\Question\Block\Frontend;

class Question extends \Magento\Framework\View\Element\Template
{
	 /**
     * @var $_questionFactory
	 * @var $_registry
	 * @var $_questionCollectionFactory
	 * @var $product
	 * @var $_urlInterface;
     */
	protected $_questionFactory;
	protected $_registry;
	protected $_questionCollectionFactory;
	protected $_product; 
	protected $_urlInterface; 
	protected $httpContext;

	/**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \AHT\Question\Model\QuestionFactory $questionFactory
	 * @param array $data
	 * @param \Magento\Framework\Registry $registry
	 * @param \AHT\Question\Model\ResourceModel\Question\CollectionFactory $questionCollectionFactory,
     * @param \Magento\Catalog\Model\ProductFactory $product
	 * @param \Magento\Framework\UrlInterface $urlInterface,   
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\AHT\Question\Model\QuestionFactory $questionFactory,
		\AHT\Question\Model\ResourceModel\Question\CollectionFactory $questionCollectionFactory,
		\Magento\Framework\Registry $registry,
		\Magento\Catalog\Model\ProductFactory $product,
		\Magento\Framework\UrlInterface $urlInterface,   
		\Magento\Framework\App\Http\Context $httpContext,
		array $data = []
	)
	{
		$this->_questionFactory = $questionFactory;
		$this->_registry = $registry;
		$this->_questionCollectionFactory = $questionCollectionFactory;
		$this->_product = $product;
		$this->_urlInterface = $urlInterface;
		$this->httpContext = $httpContext;
		parent::__construct($context, $data);
	}

	
	public function getCurrentProduct()
    {       
        return $this->_registry->registry('current_product');
    }   

	

	public function isLoggedIn()
    {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }

	public function getAllQuestion()
	{
		// $product_id=$this->getCurrentProduct()->getId();
		$question = $this->_questionCollectionFactory->create();
		$question->getSelect()->join(
			['table1join'=>$question->getTable('customer_entity')],
			'main_table.user_id = table1join.entity_id',
			array('*'))
			->where('main_table.status = 1')
			->where('main_table.type = 0');
		return $question;
	}
	public function getProduct($id)
    {
        return $this->_product->create()->load($id);
    }
	public function getCurrentUrl()
    {
        return $this->_urlInterface->getCurrentUrl();
	}
	public function getAdminAnswer($id)
	{
		$question = $this->_questionCollectionFactory->create();
		$question->getSelect()->join(
			['table1join'=>$question->getTable('customer_entity')],
			'main_table.user_id = table1join.entity_id',
			array('*'))
			->where("main_table.status = 1 AND main_table.user_id = 0");
		return $question;
	}
}