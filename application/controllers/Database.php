<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CreateDb');
    }

    public function index()
    {
        $dbName = $this->input->get('name');
        $sql = $this->createdb->exec($dbName);
        ej($sql);
    }
}
