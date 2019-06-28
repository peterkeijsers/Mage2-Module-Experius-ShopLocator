<?php

namespace Experius\ShopLocator\Api;

interface ShopLocatorRepositoryInterface
{

    /**
     * Retrieve ShopLocator
     * @param int $entityId
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

}
