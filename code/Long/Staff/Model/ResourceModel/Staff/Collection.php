<?php
namespace Long\Staff\Model\ResourceModel\Staff;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	protected function _construct(){
		$this->_init("Long\Staff\Model\Staff","Long\Staff\Model\ResourceModel\Staff");
	}
}