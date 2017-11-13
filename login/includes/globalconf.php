<?php
class GlobalConf
{
    public $conf;
    public function __construct()
    {
        require 'config.php';
        $this->ip_address = $ip_address;
        $this->base_url = $base_url;
        $this->signin_url = $signin_url;
    }

}
