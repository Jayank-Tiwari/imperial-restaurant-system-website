<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\CartItem;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Support\Carbon;

class CheckoutClosedTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Ensure test time is Wednesday
        Carbon::setTestNow(Carbon::parse('next wednesday'));
    }

    public function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_dinein_order_blocked_on_wednesday()
    {
        $user = User::factory()->create();

        // Create a menu item and cart item for the user
        $category = Category::create(['name' => 'Test Category']);

        $menu = MenuItem::create([
            'name' => 'Test Dish',
            'description' => 'Test',
            'category_id' => $category->id,
            'price' => 10.00,
            'image' => '',
            'availability' => true,
        ]);

        CartItem::create([ 'user_id' => $user->id, 'menu_item_id' => $menu->id, 'quantity' => 1 ]);

        $response = $this->actingAs($user)
            ->post(route('checkout.dinein'), ['table_no' => 1]);

        $response->assertSessionHas('error');
    }

    public function test_delivery_order_blocked_on_wednesday()
    {
        $user = User::factory()->create();

        $category = Category::create(['name' => 'Test Category']);

        $menu = MenuItem::create([
            'name' => 'Test Dish',
            'description' => 'Test',
            'category_id' => $category->id,
            'price' => 10.00,
            'image' => '',
            'availability' => true,
        ]);

        CartItem::create([ 'user_id' => $user->id, 'menu_item_id' => $menu->id, 'quantity' => 1 ]);

        $response = $this->actingAs($user)
            ->post(route('checkout.delivery'), [
                'address' => '123 Test St',
                'postal_code' => '08880',
                'payment_method' => 'cash',
            ]);

        $response->assertSessionHas('error');
    }
}
