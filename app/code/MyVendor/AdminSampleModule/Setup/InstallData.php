<?php

namespace MyVendor\AdminSampleModule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $itemsFactory;

    public function __construct(\MyVendor\AdminSampleModule\Model\ItemsFactory $itemsFactory)
    {
        $this->itemsFactory = $itemsFactory;
    }

	/**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
    	$setup->startSetup();

    	$this->_insertSampleData();

    	$setup->endSetup();
    }

    protected function _insertSampleData()
    {
    	$items = [];

        for ($i=1; $i <= 100; $i++) { 
            $items[] = [
                'title' => 'Admin Sample Module Item #' . $i
            ];
        }

        foreach ($items as $data) {
            $this->createAdminSampleModuleItem()->setData($data)->save();
        }
    }
    
    public function createAdminSampleModuleItem()
    {
        return $this->itemsFactory->create();
    }
}
