<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Experius\ShopLocator\Controller\Adminhtml\Shop;

use Experius\ShopLocator\Api\ShopLocatorRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Experius_ShopLocator::shop_delete';

    const PRIMARY_FIELD_NAME = 'entity_id';

    /**
     *  @var ShopLocatorRepositoryInterface
     */
    protected $shopLocatorRepository;


    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param ShopLocatorRepositoryInterface $shopLocatorRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ShopLocatorRepositoryInterface $shopLocatorRepository
    ) {
        parent::__construct($context);
        $this->shopLocatorRepository = $shopLocatorRepository;
    }


    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam(self::PRIMARY_FIELD_NAME);
        if ($id) {
            try {
                $shop = $this->shopLocatorRepository->getById($id);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage(__('This shop no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        }

        try {
            $shop->delete();
            $this->messageManager->addSuccessMessage(__('You deleted the shop.'));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting the shop.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
