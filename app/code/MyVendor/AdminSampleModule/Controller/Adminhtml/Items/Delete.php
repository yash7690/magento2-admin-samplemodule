<?php

namespace MyVendor\AdminSampleModule\Controller\Adminhtml\Items;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'MyVendor_AdminSampleModule::manage_items';

    protected $items;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \MyVendor\AdminSampleModule\Model\Items $items
        )
    {
        parent::__construct($context);
        $this->items = $items;
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                // init model and delete
                $items = $this->items->load($id);
                
                $items->delete();
                
                // display success message
                $this->messageManager->addSuccessMessage(__('The item has been deleted.'));
                
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a item to delete.'));
        
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
