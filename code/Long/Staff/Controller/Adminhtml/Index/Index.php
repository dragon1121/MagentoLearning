<?php

namespace Long\Staff\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action{
	protected $_resultPageFactory;
	public function __construct(Context $context, PageFactory $pageFactory){
		parent::__construct($context);
		$this->_resultPageFactory=$pageFactory;
	}
	public function execute(){
	    //setup page
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("Long_Staff::staff");
		$resultPage->getConfig()->getTitle()->prepend(__("Staff Manager"));

		return $resultPage;
	}
}