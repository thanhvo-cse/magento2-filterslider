<?php
namespace ThanhVo\FilterSlider\Model\Layer\Filter;

use Magento\CatalogSearch\Model\Layer\Filter\Decimal as AbstractFilter;

/**
 * Layer price filter based on Search API
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Decimal extends AbstractFilter
{
    public function getMinMax()
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
