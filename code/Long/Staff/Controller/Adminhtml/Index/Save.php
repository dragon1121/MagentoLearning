<?php

namespace Long\Staff\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action{
    protected $_resultPageFactory;
    protected $_coreRegistry;
    public function __construct(Context $context, PageFactory $pageFactory, Registry $registry){
        parent::__construct($context);
        $this->_coreRegistry = $registry;
        $this->_resultPageFactory=$pageFactory;
    }
    public function execute(){
        $request = $this->getRequest();
        if ($request->getPost()){
            $staffModel = $this->_objectManager->create("Long\Staff\Model\Staff"); //call Staff class
            $staffId = $request->getParam("id");
            $formData = $request->getPostValue();
            $urlRedirect = "*/*/add";
            $isDelete = 0;
            //if staffId exist (edit action)
            if ($staffId){
                $staffModel->load($staffId);
                $urlRedirect = "*/*/edit/id/".$staffModel->getId();
                $isDelete = isset($formData["avatar"]["delete"]) ? $formData["avatar"]["delete"] : 0;
                unset($formData["avatar"]); //remove avatar data, because avatar is array not string, so setData() -> error.
            }
            //set data from form to model
            $staffModel->setData($formData);

            //set avatar
            $formFile = $request->getFiles()->toArray();
            if ($formFile["avatar"]["name"]){
                $imageHelper = $this->_objectManager->get("Long\Staff\Helper\Image"); //call Image library.
                $imageFile = $imageHelper->upLoadImage("avatar");
                if ($imageFile){ //upload success
                    if ($isDelete == 1){
                        $imageHelper->removeImage($staffModel->getAvatar());
                    }
                    $staffModel->setAvatar("staff/$imageFile");
                }else{ //upload fail
                    $this->messageManager->addErrorMessage(__("Can not upload avatar, please try again."));
                    if (!$staffId){
                        $this->_getSession()->setFormData($formData);
                    }
                    return $this->_redirect($urlRedirect);
                }
            }else if (!$staffId){//In add action, avatar is request.
                $this->messageManager->addErrorMessage(__("You must upload staff avatar"));
                $this->_getSession()->setFormData($formData); //keep data
                return $this->_redirect($urlRedirect);
            }
            $staffModel->save();
            $this->messageManager->addSuccessMessage(__("The staff information has been save"));
            return $this->_redirect($urlRedirect);
        }
    }
}