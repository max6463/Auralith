<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_logs extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => TRUE
            ],
            'source_id' => [
                'type' => 'INT'
            ],
            'api_key_id' => [
                'type' => 'INT'
            ],
            'event_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'payload' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('source_id');
        $this->dbforge->create_table('logs');
    }

    public function down()
    {
        $this->dbforge->drop_table('logs');
    }
}