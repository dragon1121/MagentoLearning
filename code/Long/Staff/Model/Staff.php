<?php
namespace Long\Staff\Model;
class Staff extends \Magento\Framework\Model\AbstractModel{
	protected function _construct(){
		$this->_init("Long\Staff\Model\ResourceModel\Staff");
	}
}