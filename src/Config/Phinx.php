<?php

namespace Config;

class Phinx extends \Sys\Config\Phinx
{

    public function getRootPath(): string
    {
        return ROOT_PATH;
    }

}
