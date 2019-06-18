<?php


namespace Experius\ShopLocator\Model\ResourceModel;

class ShopLocator extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('shoplocator_shop_entity', 'entity_id');
    }
}
