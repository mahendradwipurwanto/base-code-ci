<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utility extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_home']);
    }

    public function not_found()
    {
        $this->templatefront->view('utility/not_found');
    }
}
