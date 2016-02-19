<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class JEloquent {

    private $ci;
    public  $db;

    public function __construct() {
        $this->ci = & get_instance();
        $this->db = new DB;
        $this->db->addConnection($this->ci->config->item($this->ci->config->item("default"),"conecctions"));
        $this->db->setAsGlobal();
        $this->db->bootEloquent();
    }

}
