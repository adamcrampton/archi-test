<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_get_all_properties()
    {
        $response = $this->get('/api/properties');

        $response->assertStatus(200);
    }

    public function test_get_property_by_id()
    {
        $response = $this->get('/api/properties/1');

        $response->assertStatus(200);
    }

    public function test_create_new_property()
    {
        $response = $this->post('/api/properties', [
            'suburb' => 'North Strathfield',
            'state' => 'NSW',
            'country' => 'Australia'
        ]);

        $response->assertStatus(201);
    }

    public function test_get_analytics_for_property()
    {
        $response = $this->get('/api/properties/1/analytics');

        $response->assertStatus(200);
    }

    public function test_create_analytic_for_property()
    {
        $response = $this->post('/api/properties/1/analytics', [
            'type' => 'max_Bld_Height_m',
            'value' => 1
        ]);

        $response->assertStatus(201);
    }

    public function test_update_analytic_for_property()
    {
        $response = $this->put('/api/properties/1/analytics', [
            'type' => 'max_Bld_Height_m',
            'value' => 25
        ]);

        $response->assertStatus(201);
    }

    public function test_get_analytics_for_suburb()
    {
        $response = $this->post('/api/analytics', [
            'filter' => 'suburb',
            'search' => 'parramatta'
        ]);

        $response->assertStatus(200);
    }

    public function test_get_analytics_for_state()
    {
        $response = $this->post('/api/analytics', [
           'filter' => 'state',
           'search' => 'nsw' 
        ]);

        $response->assertStatus(200);
    }

    public function test_get_analytics_for_country()
    {
        $response = $this->post('/api/analytics', [
           'filter' => 'country',
           'search' => 'australia' 
        ]);

        $response->assertStatus(200);
    }
}
