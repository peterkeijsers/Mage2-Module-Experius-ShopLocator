<?php

namespace Experius\ShopLocator\Block\Shop;

use Experius\ShopLocator\Api\ShopLocatorRepositoryInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $shopLocatorRepository;

    protected $searchCriteriaBuilder;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        ShopLocatorRepositoryInterface $shopLocatorRepository,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->shopLocatorRepository = $shopLocatorRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    public function getSearchCriteria()
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('name', '%Experius%', 'like')->create();

        return $searchCriteria;
    }

    public function getShopById($entityId)
    {
        return $this->shopLocatorRepository->getById($entityId);
    }

    public function getShopLocatorList($searchCriteria)
    {
        return $this->shopLocatorRepository->getList($searchCriteria);
    }

}