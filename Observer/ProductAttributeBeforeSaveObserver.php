<?php
namespace ThanhVo\FilterSlider\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class ProductAttributeBeforeSaveObserver implements ObserverInterface
{
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Eav\Attribute $attribute */
        $attribute = $observer->getAttribute();
        if ($attribute->getFrontendInput() == 'number') {
            if (!$attribute->getBackendModel()) {
                $attribute->setBackendModel(\ThanhVo\FilterSlider\Model\Product\Attribute\Backend\Number::class);
            }
        }
    }
}
