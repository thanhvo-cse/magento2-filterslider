<?php
namespace ThanhVo\FilterSlider\Plugin\Model\Layer\Filter;

use Magento\Eav\Model\Entity\Attribute as EntityAttribute;

class Decimal
{
    public function beforeGetBackendTypeByInput(EntityAttribute $subject, $type)
    {
        if ($type == 'number') {
            return ['price'];
        }
    }

    public function beforeGetDefaultValueByInput(EntityAttribute $subject, $type)
    {
        if ($type == 'number') {
            return ['price'];
        }
    }

}
