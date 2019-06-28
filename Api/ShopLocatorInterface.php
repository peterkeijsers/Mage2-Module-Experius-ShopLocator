<?php

namespace Experius\ShopLocator\Api;

interface ShopLocatorInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const SHOP_HOURS = 'shop_hours';

    /**
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set entityId
     *
     * @param int $entityId
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     */
    public function setEntityId($entityId);

    /**
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     */
    public function setName($name);

}