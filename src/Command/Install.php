<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Install extends Command
{

    protected function configure()
    {
        $this->setName('install');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->replaceComposerJson();

        $this->resetCommands();

        $this->cleanTemplates();

        unlink(__FILE__);
    }

    private function replaceComposerJson()
    {
        $filename = ROOT_PATH . '/composer.json';

        unlink($filename);

        $composer = array(
            "require" => array(
                "mellera/progetto-kr-007" => "0.0.1"
            )
        );

        file_put_contents($filename, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    private function resetCommands()
    {
        rename(ROOT_PATH . '/templates/commands.php', ETC_PATH . '/commands.php');
    }

    private function cleanTemplates()
    {
        unlink(ROOT_PATH . '/templates/commands.php');
        unlink(ROOT_PATH . '/templates');
    }

}
