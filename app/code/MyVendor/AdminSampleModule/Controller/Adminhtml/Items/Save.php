<?php

namespace MyVendor\AdminSampleModule\Controller\Adminhtml\Items;

use Magento\Backend\App\Action;
use MyVendor\AdminSampleModule\Model\ItemsFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'MyVendor_AdminSampleModule::manage_items';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var ItemsFactory
     */
    private $itemsFactory;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param ItemsFactory $itemsFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        ItemsFactory $itemsFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->itemsFactory = $itemsFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = true;
            }
            if (empty($data['item_id'])) {
                $data['item_id'] = null;
            }

            $model = $this->itemsFactory->create();

            $id = $this->getRequest()->getParam('item_id');

            if ($id) {
                try {
                    $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This item no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the item.'));
                $this->dataPersistor->clear('myvendor_adminsamplemodule_items');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the item.'));
            }

            $this->dataPersistor->set('myvendor_adminsamplemodule_items', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('item_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}