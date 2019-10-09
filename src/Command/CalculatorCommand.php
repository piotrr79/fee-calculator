<?php
declare(strict_types=1);

namespace Fee\Calculator\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
// DI Container
use Symfony\Component\DependencyInjection\ContainerBuilder;
// FeeCalculator
use Fee\Calculator\Model\LoanApplication;

/**
 * Calculator Console Command
 *
 * @package Fee Calculator
 */
class CalculatorCommand extends Command
{
    protected static $defaultName = 'app:calculate';

    protected function configure()
    {
        $this
            ->setDescription('Calculate')
            ->addArgument('term', InputArgument::REQUIRED, 'Set term')
            ->addArgument('amount', InputArgument::REQUIRED, 'Set amount');
    }

    /**
     * Get service FeeCalculatorManager from DI Container
     *
     * @return object
     *
     * @todo Add config yaml file to define and register services in config instead of registering them in code
     */
    private function getContainer()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->register('fcm', 'Fee\Calculator\Manager\FeeCalculatorManager');
        $validator = $containerBuilder->get('fcm');

        return $validator;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $term = $input->getArgument('term');
        $amount = $input->getArgument('amount');

        if ($term) {
            $io->note(sprintf('You passed term: %s', $term));
        }

        if ($amount) {
            $io->note(sprintf('You passed amount: %s', $amount));
        }

        /** @internal Load fcm service from DI container */
        $fcm = $this->getContainer();
        $application = new LoanApplication((int)$term, (float)$amount);
        $output = $fcm->calculate($application);

        $io->success('Fee: '.$output);
    }
}
