<?php


namespace Long\Staff\Block\Adminhtml\Staff\Edit;


use Long\Staff\Model\Config\Status;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;

class Form extends Generic
{
    protected $_staffStatus;
    public function __construct(Context $context, Registry $registry, FormFactory $formFactory, Status $status, array $data = [])
    {
        $this->_staffStatus = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _construct()
    {
        $this->setId("staff_form");
        $this->setTitle(__("Staff Infomation"));
        parent::_construct();
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry("staff");
        $form = $this->_formFactory->create([
            "data" => [
                "id" => "edit_form",
                "action" => $this->getData("action"),
                "method" => "post",
                "enctype" => "multipart/form-data",
            ]
        ]);
        $fieldset = $form->addFieldset(
            "base_fieldset",
            [
                "legend" => __("General Information"),
                "class" => "fieldset-wide"
            ]);
        if($model->getId()){
            $fieldset->addField(
                "id",
                "hidden",
                [
                    "name" => "id",
                ]
            );
        }
        $fieldset->addField(
            "name",
            "text",
            [
                "name" => "name",
                "label" => __("Full Name"),
                "required" => true,
            ]);
        $fieldset->addField(
            "email",
            "text",
            [
                "name" => "email",
                "label" => __("Email"),
                "required" => true,
            ]);
        $fieldset->addField(
            "phone",
            "text",
            [
                "name" => "phone",
                "label" => __("Phone"),
                "required" => true,
            ]);
        $fieldset->addField(
            "position",
            "text",
            [
                "name" => "position",
                "label" => __("Position"),
                "required" => true,
            ]);
        $fieldset->addField(
            "status",
            "select",
            [
                "name" => "status",
                "label" => __("Status"),
                "required" => true,
                "options" => $this->_staffStatus->toOptionArray(),
            ]);
        $fieldset->addField(
            "avatar",
            "image",
            [
                "name" => "avatar",
                "label" => __("Avatar"),
                "required" => true,
            ]);
        $data = $model->getData();
        $form->setValues($data);
        $form->setHtmlIdPrefix("staff_info_");
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}