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

    /**
     * @return string|null
     */
    public function getLatitude();

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     */
    public function setLatitude($latitude);

    /**
     * @return string|null
     */
    public function getLongitude();

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     */
    public function setLongitude($longitude);

    /**
     * @return string|null
     */
    public function getShopHours();

    /**
     * Set shop_hours
     *
     * @param string $shopHours
     * @return \Experius\ShopLocator\Api\ShopLocatorInterface
     */
    public function setShopHours($shopHours);

}