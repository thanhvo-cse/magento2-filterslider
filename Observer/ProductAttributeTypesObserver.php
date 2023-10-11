<?php
namespace ThanhVo\FilterSlider\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class ProductAttributeTypesObserver implements ObserverInterface
{
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Framework\DataObject $response */
        $response = $observer->getEvent()->getResponse();
        $types = $response->getTypes();
        $types[] = [
            'value' => 'number',
            'label' => __('Number'),
        ];

        $response->setTypes($types);
    }
}
