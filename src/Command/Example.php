<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Example extends Command
{

    protected function configure()
    {
        $this->setName('example');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Fai cose
    }

}
