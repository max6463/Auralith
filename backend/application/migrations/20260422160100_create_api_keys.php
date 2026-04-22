<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_api_keys extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'source_id' => [
                'type' => 'INT'
            ],
            'api_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'last_used_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'revoked_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('api_key');
        $this->dbforge->create_table('api_keys');
    }

    public function down()
    {
        $this->dbforge->drop_table('api_keys');
    }
}