<?php

namespace Experius\ShopLocator\Api;

use \Experius\ShopLocator\Api\ShopLocatorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ShopLocatorRepositoryInterface
{

    /**
     * Retrieve ShopLocator
     * @param int $entityId
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

    /**
     * @param \Experius\ShopLocator\Api\ShopLocatorInterface $ShopLocator
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     */
    public function save(ShopLocatorInterface $ShopLocator);

    /**
     * @param \Experius\ShopLocator\Api\ShopLocatorInterface $ShopLocator
     * @return void
     */
    public function delete(ShopLocatorInterface $ShopLocator);


    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

}
