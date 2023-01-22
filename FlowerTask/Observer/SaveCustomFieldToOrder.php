<?php
declare(strict_types=1);

/**
 * copyright@Abdullah_tariq
 */
namespace Abdullah\FlowerTask\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteRepository;

class SaveCustomFieldToOrder implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $quote = $event->getQuote();
        $order = $event->getOrder();
        $order->setData('flower_type', $quote->getData('flower_type'));
        $order->setData('flower_comment', $quote->getData('flower_comment'));
    }
}
