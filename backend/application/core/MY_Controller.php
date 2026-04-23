<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller  extends CI_Controller {

    protected $apiKeyData = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    protected function authenticate()
    {
        $apiKey = $this->input->get_request_header('X-API-KEY');
    
        if (!$apiKey) {
            $this->respondError('Missing API key', 401);
            exit;
        }
    
        $query = $this->db->get_where('api_keys', [
            'api_key' => $apiKey
        ]);
    
        $keyData = $query->row();
    
        if (!$keyData) {
            $this->respondError('Invalid API key', 403);
            exit;
        }
    
        $this->apiKeyData = $keyData;
    }

    protected function respond($data = [], $code = 200)
    {
        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'ok',
                'data' => $data
            ]));
    }

    protected function respondError($message, $code = 400)
    {
        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'error',
                'message' => $message
            ]))
            ->_display();

        exit;
    }

    protected function getJsonInput()
    {
        return json_decode($this->input->raw_input_stream, true);
    }
}