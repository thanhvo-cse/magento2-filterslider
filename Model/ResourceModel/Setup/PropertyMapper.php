<?php
namespace ThanhVo\FilterSlider\Model\ResourceModel\Setup;

use Magento\Eav\Model\Entity\Setup\PropertyMapperInterface;
use Magento\Eav\Model\Entity\Setup\PropertyMapperAbstract;

class PropertyMapper extends PropertyMapperAbstract implements PropertyMapperInterface
{
    /**
     * Map input attribute properties to storage representation
     *
     * @param array $input
     * @param int $entityTypeId
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function map(array $input, $entityTypeId)
    {
        return [
            'filter_as_slider' => $this->_getValue($input, 'filter_as_slider'),
            'filter_slider_from_pattern' => $this->_getValue($input, 'filter_slider_from_pattern'),
            'filter_slider_to_pattern' => $this->_getValue($input, 'filter_slider_to_pattern'),
        ];
    }
}
