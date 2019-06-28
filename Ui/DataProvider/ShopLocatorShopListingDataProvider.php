<?php

namespace Experius\ShopLocator\Ui\DataProvider;

use Experius\ShopLocator\Model\ResourceModel\ShopLocator\CollectionFactory;

class ShopLocatorShopListingDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var CollectionFactory
     * @since 100.1.0
     */
    protected $collectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = [],
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}