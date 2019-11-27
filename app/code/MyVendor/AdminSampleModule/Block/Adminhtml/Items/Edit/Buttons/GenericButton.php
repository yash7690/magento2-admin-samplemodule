<?php

namespace MyVendor\AdminSampleModule\Block\Adminhtml\Items\Edit\Buttons;

use Magento\Backend\Block\Widget\Context;
use MyVendor\AdminSampleModule\Model\ItemsFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ItemsFactory
     */
    protected $itemsFactory;

    /**
     * @param Context $context
     * @param ItemsFactory $itemsFactory
     */
    public function __construct(
        Context $context,
        ItemsFactory $itemsFactory
    ) {
        $this->context = $context;
        $this->itemsFactory = $itemsFactory;
    }

    public function getItemId()
    {
        try {
            return $this->itemsFactory->create()->load(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}