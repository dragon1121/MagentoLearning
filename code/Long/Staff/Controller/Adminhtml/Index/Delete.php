<?php


namespace Long\Staff\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;

class Delete extends Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam("id");
        if ($id) {
            try {
                $model = $this->_objectManager->create("Long\Staff\Model\Staff");
                $model->load($id);
                if ($model->getId()) {
                    $imageHelper = $this->_objectManager->get("Long\Staff\Helper\Image"); //call Image library.
                    $imageHelper->removeImage($model->getAvatar());
                    $model->delete();
                    $this->messageManager->addSuccessMessage(__("This staff has been deleted"));
                    $this->_redirect("*/*/");
                } else {
                    $this->messageManager->addErrorMessage(__("This staff no longer exist"));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                return $this->_redirect("*/*/");
            }
        } else {
            $this->messageManager->addErrorMessage(__("We can not find any id to delete"));
            return $this->_redirect("*/*/");
        }
    }
}