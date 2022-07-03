<?php

namespace App\Ui\Command;

use App\Application\Readings\Converter\File\ImporterReadingsFile;
use App\Application\Readings\FinderSuspiciousReadings;
use App\Infrastructure\Shared\Symfony\Command\AbstractSymfonyCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import_file')]
class ImportFileCommand extends AbstractSymfonyCommand
{

    protected function configure()
    {
        $this
            ->setDescription('Process import file')
            ->setHelp('This command import file')
            ->addArgument('file', InputArgument::REQUIRED, 'File and path')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');
        $this->getSyncCommandBus()->dispatch(new ImporterReadingsFile($file));
        $response = $this->getSyncCommandBus()->dispatch(new FinderSuspiciousReadings());

        foreach ($response as $data) {
            $output->writeln($data->__toString());
        }

        return Command::SUCCESS;
    }
}