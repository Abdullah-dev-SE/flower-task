<?php
declare(strict_types=1);

/**
 * copyright@Abdullah_tariq
 */
namespace Abdullah\FlowerTask\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

/**
 * Class FlowerShop
 */
class FlowerShop extends Command
{
    const ARG_NAME_CUSTOMER_ID = 'customer-id';
    const OPT_NAME_FLOWER_TYPE = 'type';

    private CollectionFactory $orderCollectionFactory;


    /**
     * @param string|null $name
     */
    public function __construct(
        CollectionFactory $orderCollectionFactory,
        string $name = null
    ) {
        parent::__construct($name);
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('customer-data:run')
            ->setDescription('Get order details along custom data(Flower Shop)')
            ->addArgument(
                self::ARG_NAME_CUSTOMER_ID,
                InputArgument::REQUIRED,
                "Customer ID"
            )
            ->addOption(
                self::OPT_NAME_FLOWER_TYPE,
                null,
                InputOption::VALUE_OPTIONAL,
                'Flower Type'
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customerId = (int) $input->getArgument(self::ARG_NAME_CUSTOMER_ID);

        $customerOrder = $this->orderCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId);
        $output->writeln(print_r($customerOrder->getData(), true));

        return 0;
    }
}
