<?php
namespace ThanhVo\FilterSlider\Plugin\Model\Entity;

use Magento\Eav\Model\Entity\Attribute as EntityAttribute;

class Attribute
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
