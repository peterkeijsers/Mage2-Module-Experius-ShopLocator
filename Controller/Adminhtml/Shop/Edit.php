<?php

namespace Experius\ShopLocator\Controller\Adminhtml\Shop;

use Experius\ShopLocator\Api\ShopLocatorRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Experius_ShopLocator::shop_edit';

    const PRIMARY_FIELD_NAME = 'entity_id';

    /**
     * @var \Magento\Framework\View\Result\Page
     */
    protected $resultPageFactory;

    /**
     *  @var \Experius\ShopLocator\Api\ShopLocatorRepositoryInterface
     */
    protected $shopLocatorRepository;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Experius\ShopLocator\Api\ShopLocatorRepositoryInterface $ShopLocatorRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ShopLocatorRepositoryInterface $shopLocatorRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->shopLocatorRepository = $shopLocatorRepository;
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(self::PRIMARY_FIELD_NAME);
        if($id){
            $shop = $this->shopLocatorRepository->getById($id);

            if(!$shop->getId()){
                $this->messageManager->addErrorMessage(__('This Shoplocator shop no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()
            ->prepend( isset($shop) ? $shop->getTitle() : __('New Shop'));

        return $resultPage;
    }
}
