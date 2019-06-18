<?php

namespace Experius\ShopLocator\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class InstallShopLocatorShopExampleData implements DataPatchInterface
{

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->moduleDataSetup->getConnection()->insertMultiple(
            $this->moduleDataSetup->getTable('shoplocator_shop_entity'),
            [
                [
                    'name' => 'Experius kantoor',
                    'latitude' => '52.090417',
                    'longitude' => '5.1460993',
                    'shop_hours' => '{"monday": {"opening":"09:00", "closing": "18:00"},"tuesday": {"opening":"09:00", "closing": "18:00"}, "wednesday": {"opening":"09:00", "closing": "18:00"},"thursday": {"opening":"09:00", "closing": "18:00"}, "friday": {"opening":"09:00", "closing": "18:00"},"saturday": {"opening":"09:00", "closing": "18:00"},"sunday": {"opening":"09:00", "closing": "18:00"}}'
                ],
                [
                    'name' => 'Peters huis',
                    'latitude' => '51.090417',
                    'longitude' => '3.1460993',
                    'shop_hours' => '{"monday": {"opening":"09:00", "closing": "18:00"},"tuesday": {"opening":"09:00", "closing": "18:00"}, "wednesday": {"opening":"09:00", "closing": "18:00"},"thursday": {"opening":"09:00", "closing": "18:00"}, "friday": {"opening":"09:00", "closing": "18:00"},"saturday": {"opening":"09:00", "closing": "18:00"},"sunday": {"opening":"09:00", "closing": "18:00"}}'
                ]
            ]
        );

        $this->moduleDataSetup->endSetup();
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

}