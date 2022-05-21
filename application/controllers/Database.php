<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
    }

    public function createBaseDb()
    {
        $dbName = $this->input->get('dbName');
        $sql = $this->createdb->exec($dbName);
        ej($sql);
    }
}
