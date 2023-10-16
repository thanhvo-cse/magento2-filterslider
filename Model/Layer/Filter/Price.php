<?php
namespace ThanhVo\FilterSlider\Model\Layer\Filter;

use Magento\CatalogSearch\Model\Layer\Filter\Price as AbstractFilter;

/**
 * Layer price filter based on Search API
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Price extends AbstractFilter
{
    /**
     * Get attribute min max
     * 
     * @return array
     */
    public function getMinMax(): array
    {
        $min = 0;
        $max = 0;
        foreach ($this->_items as $item) {
            list($left, $right) = explode('-', $item->getValue());
            $min = floatval(min($min, $left));
            $max = floatval(max($max, $right));
        }

        return [$min, $max];
    }
}
