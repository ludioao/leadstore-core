<?php

namespace LeadStore\Framework\Tests\Controller;

use LeadStore\Framework\Tests\BaseTestCase;

 /**
 * Test the module Routes
 */
class ModuleTest extends BaseTestCase
{
    /**
     * Test the module Index Route
     * @test
     */
    public function test_module_index_route()
    {
        $user = $this->_getAdminUser();
        $response = $this->actingAs($user, 'admin')->get(route('admin.module.index'));

        $response->assertStatus(200)
            ->assertSee(__('avored-framework::system.module-list'));
    }

}
