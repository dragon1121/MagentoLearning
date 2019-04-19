<?php

namespace Long\Staff\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action{
	protected $_resultPageFactory;
	protected $_coreRegistry;
	public function __construct(Context $context, PageFactory $pageFactory, Registry $registry){
		parent::__construct($context);
		$this->_coreRegistry = $registry;
		$this->_resultPageFactory=$pageFactory;
	}
	public function execute(){
	    $staffId = $this->getRequest()->getParam("id"); //get Id
        $model = $this->_objectManager->create("Long\Staff\Model\Staff"); //call Staff class
	    if($staffId){ //if staff id exist then load staff's information
	        $model->load($staffId);
	        if(!$model->getId()){
	            $this->messageManager->addErrorMessage(__("This staff no longer exist"));
	            return $this->_redirect("*/*/");
            }
	        $title = "Edit staff: ".$model->getName();
        }
	    else{
	        $title = "Add a new staff";
        }
        //get staff's information into form
	    $data = $this->_session->getFormData(true);
	    if (!empty($data)){
	        $model->setData($data);
        }
	    $this->_coreRegistry->register("staff", $model);
	    //setup page
		$resultPage=$this->_resultPageFactory->create();
		$resultPage->setActiveMenu("Long_Staff::staff");
		$resultPage->getConfig()->getTitle()->prepend(__($title));

		return $resultPage;
	}
}