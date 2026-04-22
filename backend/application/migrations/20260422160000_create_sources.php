<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_sources extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'active'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sources');
    }

    public function down()
    {
        $this->dbforge->drop_table('sources');
    }
}