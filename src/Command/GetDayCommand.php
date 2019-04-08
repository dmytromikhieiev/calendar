<?php

namespace App\Command;

use App\Calendar;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetDayCommand
 */
class GetDayCommand extends Command
{
    protected static $defaultName = 'get-day';

    /**
     * @var Calendar
     */
    private $calendar;

    /**
     * GetDayCommand constructor.
     *
     * @param Calendar $calendar
     * @param null $name
     */
    public function __construct(Calendar $calendar, $name = null)
    {
        $this->calendar = $calendar;
        parent::__construct($name);
    }

    /**
     * configure
     */
    protected function configure()
    {
        $this->setDescription('Gets day of week.')
            ->setHelp('Gets day of week by date')
            ->addArgument('date', InputArgument::REQUIRED, 'date in format dd.mm.yyyy.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $day = $this->calendar->getDayByDate($input->getArgument('date'));
            $output->writeln($day);
        } catch (\Throwable $ex) {
            $output->writeln($ex->getMessage());
        }
    }
}
