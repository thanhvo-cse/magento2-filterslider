<?php
namespace ThanhVo\FilterSlider\Model\Product\Attribute\Backend;

use Magento\Catalog\Model\Attribute\ScopeOverriddenValue;

/**
 * Backend model for set of EAV attributes with 'frontend_input' equals 'number'.
 */
class Number extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Catalog helper
     *
     * @var \Magento\Catalog\Helper\Data
     */
    protected $_helper;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Currency factory
     *
     * @var \Magento\Directory\Model\CurrencyFactory
     */
    protected $_currencyFactory;

    /**
     * Core config model
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_config;

    /**
     * @var \Magento\Framework\Locale\FormatInterface
     */
    protected $localeFormat;

    /**
     * @param \Magento\Directory\Model\CurrencyFactory $currencyFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Helper\Data $catalogData
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param ScopeOverriddenValue|null $scopeOverriddenValue
     */
    public function __construct(
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Helper\Data $catalogData,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\Locale\FormatInterface $localeFormat
    ) {
        $this->_currencyFactory = $currencyFactory;
        $this->_storeManager = $storeManager;
        $this->_helper = $catalogData;
        $this->_config = $config;
        $this->localeFormat = $localeFormat;
    }

    /**
     * Validate
     *
     * @param \Magento\Catalog\Model\Product $object
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool
     */
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (empty($value)) {
            return parent::validate($object);
        }

        if (!$this->isPositiveOrZero($value)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Please enter a number 0 or greater in this field.')
            );
        }

        return true;
    }

    /**
     * Returns whether the value is greater than, or equal to, zero
     *
     * @param mixed $value
     * @return bool
     */
    protected function isPositiveOrZero($value)
    {
        $value = $this->localeFormat->getNumber($value);
        $isNegative = $value < 0;
        return  !$isNegative;
    }
}
