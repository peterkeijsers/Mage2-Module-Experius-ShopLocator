<?php


namespace Experius\ShopLocator\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Experius\ShopLocator\Model\ResourceModel\ShopLocator as ResourceShopLocator;
use Experius\ShopLocator\Model\ResourceModel\ShopLocator\CollectionFactory as ShopLocatorCollectionFactory;

class ShopLocatorRepository
{
    protected $resource;

    protected $shopLocatorFactory;

    protected $shopLocatorCollectionFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    protected $searchResultsFactory;

    private $storeManager;

    private $collectionProcessor;

    /**
     * @param ResourceShopLocator $resource
     * @param ShopLocatorFactory $shopLocatorFactory
     * @param ShopLocatorCollectionFactory $shopLocatorCollectionFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceShopLocator $resource,
        ShopLocatorFactory $shopLocatorFactory,
        ShopLocatorCollectionFactory $shopLocatorCollectionFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->resource = $resource;
        $this->shopLocatorFactory = $shopLocatorFactory;
        $this->shopLocatorCollectionFactory = $shopLocatorCollectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($shopLocatorId)
    {
        $shopLocator = $this->shopLocatorFactory->create();
        $shopLocator->load($shopLocatorId);
        if (!$shopLocator->getId()) {
            throw new NoSuchEntityException(__('ShopLocator with id "%1" does not exist.', $shopLocatorId));
        }
        return $shopLocator;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Magento\Cms\Model\ResourceModel\Page\Collection $collection */
        $collection = $this->shopLocatorCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\PageSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

}