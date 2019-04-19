<?php


namespace Long\Staff\Block\Adminhtml\Staff;



use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    protected function _construct()
    {
        $this->_blockGroup = "Long_Staff";
        $this->_controller = "adminhtml_staff";
        $this->_objectId = "id";
        parent::_construct();
    }
}