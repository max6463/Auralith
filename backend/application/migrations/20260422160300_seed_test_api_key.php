<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Seed_test_api_key extends CI_Migration
{
    // Centralized test API key (easy to change later)
    private const TEST_API_KEY = 'auralith_dev_9f3c7b2a1d8e4f6c8a0d2e5b7c1f9a3d';

    public function up()
    {
        // Ensure source exists
        $source = $this->db->get_where('sources', [
            'name' => 'Test Sensor'
        ])->row();

        if (!$source) {
            $this->db->insert('sources', [
                'name' => 'Test Sensor',
                'description' => 'Local development source',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $source_id = $this->db->insert_id();
        } else {
            $source_id = $source->id;
        }

        // Insert API key if not exists
        $exists = $this->db->get_where('api_keys', [
            'api_key' => self::TEST_API_KEY
        ])->row();

        if (!$exists) {
            $this->db->insert('api_keys', [
                'source_id' => $source_id,
                'api_key' => self::TEST_API_KEY,
                'name' => 'Local Dev Key',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function down()
    {
        $this->db->where('api_key', self::TEST_API_KEY);
        $this->db->delete('api_keys');

        $this->db->where('name', 'Test Sensor');
        $this->db->delete('sources');
    }
}
