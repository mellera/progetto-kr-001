<?php

namespace Config;

class Web extends \Sys\Config\Web
{

    public function getRootPath(): string
    {
        return ROOT_PATH;
    }

}
