<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingest extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // Load DB
        $this->load->database();

        // Load helpers
        $this->load->helper('url');
    }

    public function index()
    {
        $this->authenticate();

        $input = $this->getJsonInput();

        return $this->respond([
            'api_key_id' => $this->apiKeyData->id,
            'received' => $input
        ]);
    }
}