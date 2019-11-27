<?php

namespace MyVendor\AdminSampleModule\Model;

class Items extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'myvendor_adminsamplemodule_items';

	protected $_cacheTag = 'myvendor_adminsamplemodule_items';

	protected $_eventPrefix = 'myvendor_adminsamplemodule_items';

	protected function _construct()
	{
		$this->_init(\MyVendor\AdminSampleModule\Model\ResourceModel\Items::class);
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}