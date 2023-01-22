<?php

namespace Abdullah\FlowerTask\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public function getCustomerGroup(): string
    {
        return (string)$this->scopeConfig->getValue(
            'custom_section/custom/customer_group_list',
            ScopeInterface::SCOPE_STORE);
    }
}
