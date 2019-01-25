<?php

namespace LeadStore\Framework\Tests\Controller;

use LeadStore\Framework\Tests\BaseTestCase;

class DashboardTest extends BaseTestCase
{
    /**
     * Test to check if admin dashboard get controller is working
     *
     * @return void
     */
    public function testDashboardRouteTest()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }
}
