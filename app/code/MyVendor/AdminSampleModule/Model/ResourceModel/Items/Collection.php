<?php

namespace MyVendor\AdminSampleModule\Model\ResourceModel\Items;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'item_id';
	protected $_eventPrefix = 'myvendor_adminsamplemodule_items_collection';
	protected $_eventObject = 'items_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init(
			\MyVendor\AdminSampleModule\Model\Items::class,
			\MyVendor\AdminSampleModule\Model\ResourceModel\Items::class
		);
	}
}
