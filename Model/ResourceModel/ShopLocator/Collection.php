<?php


namespace Experius\ShopLocator\Model\ResourceModel\ShopLocator;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Experius\ShopLocator\Model\ShopLocator::class,
            \Experius\ShopLocator\Model\ResourceModel\ShopLocator::class
        );
    }
}
