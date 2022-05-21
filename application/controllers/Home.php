<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_home']);
    }

    public function index()
    {
        $this->templatefront->view('home/home');
    }
}
