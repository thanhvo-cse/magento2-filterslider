<?php
namespace ThanhVo\FilterSlider\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use \Magento\Config\Model\Config\Source\Yesno;

class AddFieldsToAttributeObserver implements ObserverInterface
{
    /**
     * @var Yesno
     */
    protected $yesNo;

    /**
     * @param Yesno $yesNo
     */
    public function __construct(Yesno $yesNo)
    {
        $this->yesNo = $yesNo;
    }

    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $observer->getForm();
        $fieldset = $form->getElement('front_fieldset');
        $yesnoSource = $this->yesNo->toOptionArray();
        $fieldset->addField(
            'filter_as_slider',
            'select',
            [
                'name' => 'filter_as_slider',
                'label' => __('Filter as slider'),
                'title' => __('Filter as slider'),
                'note' => __('Can be used only with catalog input type Price and Number'),
                'values' => $yesnoSource,
            ],
            'is_filterable'
        );
    }
}
