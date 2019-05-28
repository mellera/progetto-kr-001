<?php

namespace Config;

class Cli extends \Sys\Config\Cli
{

    public function getRootPath(): string
    {
        return ROOT_PATH;
    }

}
