<?php

namespace Experius\ShopLocator\Model;

use Experius\ShopLocator\Model\ResourceModel\ShopLocator as ResourceModel;

class ShopLocator extends \Magento\Framework\Model\AbstractExtensibleModel
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const SHOP_HOURS = 'shop_hours';


    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Get entity_id
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param int $entityId
     * @return \Experius\ShopLocator\Api\Data\ShopLocatorInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get name
     * @return int
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param int $name
     * @return \Experius\ShopLocator\Api\Data\ShopLocatorInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get latitude
     * @return string
     */
    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * Set latitude
     * @param string $latitude
     * @return \Experius\ShopLocator\Api\Data\ShopLocatorInterface
     */
    public function setLatitude($latitude)
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * Get longitude
     * @return string
     */
    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * Set longitude
     * @param string $longitude
     * @return \Experius\ShopLocator\Api\Data\ShopLocatorInterface
     */
    public function setLongitude($longitude)
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    /**
     * Get shop_hours
     * @return string
     */
    public function getShopHours()
    {
        return $this->getData(self::SHOP_HOURS);
    }

    /**
     * Set shop_hours
     * @param string $shopHours
     * @return \Experius\ShopLocator\Api\Data\ShopLocatorInterface
     */
    public function setShopHours($shopHours)
    {
        return $this->setData(self::SHOP_HOURS, $shopHours);
    }
}