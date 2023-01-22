<?php

namespace Abdullah\FlowerTask\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;

class Save extends Action
{
    protected QuoteIdMaskFactory $quoteIdMaskFactory;

    protected CartRepositoryInterface $quoteRepository;

    public function __construct(
        Context $context,
        QuoteIdMaskFactory $quoteIdMaskFactory,
        CartRepositoryInterface $quoteRepository
    ) {
        parent::__construct($context);
        $this->quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    /**
     * @return void
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        if ($post) {
            $cartId       = $post['cartId'];
            $flowerType = $post['flower_type'];
            $flowerComment = $post['flower_comment'];
            $loggin       = $post['is_customer'];
            if ($loggin === 'false') {
                $cartId = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id')->getQuoteId();
            }
            $quote = $this->quoteRepository->getActive($cartId);
            $quote->setData('flower_type', $flowerType);
            $quote->setData('flower_comment', $flowerComment);
            $this->quoteRepository->save($quote);
        }
    }
}
