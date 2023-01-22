<?php
declare(strict_types=1);

/**
 * copyright@Abdullah_tariq
 */

namespace Abdullah\FlowerTask\Plugin\Checkout;

use Abdullah\FlowerTask\Helper\Data;
use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    private Data $data;

    public function __construct(
        Data $data
    )
    {

        $this->data = $data;
    }

    /**
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array           $jsLayout
    )
    {
        if ($this->data->getCustomerGroup() == 1) {
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']['flower_type'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress',
                    'template' => 'ui/form/field',
                    'options' => [],
                    'id' => 'flower_type'
                ],
                'dataScope' => 'shippingAddress.flower_type',
                'label' => __('Flower Type'),
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [],
                'sortOrder' => 200,
                'id' => 'flower_type'
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']['flower_comment'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress',
                    'template' => 'ui/form/field',
                    'options' => [],
                    'id' => 'flower_comment'
                ],
                'dataScope' => 'shippingAddress.flower_comment',
                'label' => __('Comments about flower here'),
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [],
                'sortOrder' => 200,
                'id' => 'flower_comment'
            ];
        }
        return $jsLayout;
    }
}

