<?php

namespace MyVendor\AdminSampleModule\Controller\Adminhtml\Items;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'MyVendor_AdminSampleModule::manage_items';

	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
		)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Items')));
		$resultPage->setActiveMenu('MyVendor_AdminSampleModule::manage_items');

		return $resultPage;
	}
}
