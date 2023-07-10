<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function index()
    {
        $this->load->helper('directory');
        $this->load->helper('url');
		$jsonData = file_get_contents(base_url() . 'assets/json/Task.json');
        // $data['jsonData'] = $jsonData;
        $data['jsonData'] = json_decode($jsonData, true);
        $this->load->view('reports', $data);
    }
}