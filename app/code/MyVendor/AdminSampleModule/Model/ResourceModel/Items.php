<?php

namespace MyVendor\AdminSampleModule\Model\ResourceModel;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	) {
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('myvendor_adminsamplemodule_items', 'item_id');
	}
}
