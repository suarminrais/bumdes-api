<?php

namespace Tests\Feature\API;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_products()
    {
        Sanctum::actingAs(User::factory()->create([
            'type' => 'user',
        ]));

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200);
    }

    public function test_can_get_product()
    {
        $product = Product::factory()->create([
            'user_id' => User::factory()->create(),
        ]);
        Sanctum::actingAs(User::factory()->create([
            'type' => 'user',
        ]));

        $response = $this->get("/api/v1/products/$product->id");

        $response->assertStatus(200)
            ->assertJson([
                'name' => $product->name,
            ]);
    }

    public function test_can_get_products_as_admin()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('/api/v1/products');

        $response->assertStatus(200);
    }

    public function test_can_not_get_products()
    {
        $response = $this->get('/api/v1/products');

        $response->assertStatus(500);
    }
}
