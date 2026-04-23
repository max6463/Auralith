<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Remove_source_from_api_keys extends CI_Migration {

    public function up()
    {
        if ($this->db->field_exists('source_id', 'api_keys')) {
            $this->dbforge->drop_column('api_keys', 'source_id');
        }
    }

    public function down()
    {
        $fields = [
            'source_id' => [
                'type' => 'INT',
                'null' => TRUE
            ]
        ];

        $this->dbforge->add_column('api_keys', $fields);
    }
}