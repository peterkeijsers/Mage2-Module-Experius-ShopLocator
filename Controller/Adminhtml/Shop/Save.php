<?php

namespace Experius\ShopLocator\Controller\Adminhtml\Shop;

use Experius\ShopLocator\Api\ShopLocatorRepositoryInterface;
use Experius\ShopLocator\Model\ShopLocatorFactory;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;

class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Experius_ShopLocator::shop_save';

    const PRIMARY_FIELD_NAME = 'entity_id';

    /**
     * @var \Magento\Framework\View\Result\Page
     */
    protected $resultPageFactory;

    /**
     *  @var ShopLocatorRepositoryInterface
     */
    protected $shopLocatorRepository;

    /**
     *  @var ShopLocatorFactory
     */
    protected $shopLocatorFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param ShopLocatorRepositoryInterface $shopLocatorRepository
     * @param ShopLocatorFactory $shopLocatorFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ShopLocatorRepositoryInterface $shopLocatorRepository,
        ShopLocatorFactory $shopLocatorFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->shopLocatorRepository = $shopLocatorRepository;
        $this->shopLocatorFactory = $shopLocatorFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            $model = $this->shopLocatorFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->shopLocatorRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This shop no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->shopLocatorRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the shop.'));
                return $this->processShopReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the shop.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param $model
     * @param $data
     * @param $resultRedirect
     * @return mixed
     */
    private function processShopReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } else if ($redirect === 'duplicate') {
            $duplicateModel = $this->shopLocatorFactory->create(['data' => $data]);
            $this->shopLocatorRepository->save($duplicateModel);
            $id = $duplicateModel->getEntityId();
            $this->messageManager->addSuccessMessage(__('You duplicated the shop.'));
            $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }
        return $resultRedirect;
    }
}
