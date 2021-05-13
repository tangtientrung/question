<?php

namespace AHT\Question\Block\Frontend;

class Question extends \Magento\Framework\View\Element\Template
{
	 /**
     * @var $_questionFactory
	 * @var $_registry
	 * @var $_customerSession
	 * @var $_questionCollectionFactory
	 * @var $product
	 * @var $_urlInterface;
     */
	protected $_questionFactory;
	protected $_registry;
	protected $_customerSession;
	protected $_questionCollectionFactory;
	protected $product; 
	protected $_urlInterface; 
	protected $httpContext;

	/**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \AHT\Question\Model\QuestionFactory $questionFactory
	 * @param array $data
	 * @param \Magento\Framework\Registry $registry
	 * @param \Magento\Customer\Model\Session $customerSession
	 * @param \AHT\Question\Model\ResourceModel\Question\CollectionFactory $questionCollectionFactory,
     * @param \Magento\Catalog\Model\ProductFactory $product
	 * @param \Magento\Framework\UrlInterface $urlInterface,   
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\AHT\Question\Model\QuestionFactory $questionFactory,
		\Magento\Customer\Model\Session $customerSession,
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
		$this->_customerSession = $customerSession;
		$this->_questionCollectionFactory = $questionCollectionFactory;
		$this->product = $product;
		$this->_urlInterface = $urlInterface;
		$this->httpContext = $httpContext;
		parent::__construct($context, $data);
	}

	// public function getPost(){
	// 	$post = $this->_postFactory->create();
	// 	return $post->getCollection();
	// }
	public function getCurrentProduct()
    {       
        return $this->_registry->registry('current_product');
    }   

	public function getUser()
	{
		if ($this->_customerSession->isLoggedIn()) {
			return $this->_customerSession->getId();
		} else {
			return false;
		}
		// return $this->_customerSession;
	}

	public function isLoggedIn()
    {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }

	public function getAllData()
	{
		$product_id=$this->getCurrentProduct()->getId();
		$question = $this->_questionCollectionFactory->create();
		$question->getSelect()->join(
			['table1join'=>$question->getTable('customer_entity')],
			'main_table.user_id = table1join.entity_id',
			array('*'))
			->where('main_table.status', array('eq' => '1'));
		return $question;
	}
	public function getProduct($id)
    {
        return $this->product->create()->load($id);
    }
	public function getCurrentUrl()
    {
        return $this->_urlInterface->getCurrentUrl();
	}
}