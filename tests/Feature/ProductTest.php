<?php

namespace Tests\Feature;

use App\Models\Basket_item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function all_products_can_be_viewed()
    {
        $this->withoutExceptionHandling();

        $attributes = [
                'name' => 'Pioneer DJ Mixer',
                'price' => 699,
        ];

        $this->assertDatabaseHas('products', $attributes);

        $this->get('/api/product')->assertSee($attributes);
    }

    /** @test */
    public function a_product_can_be_added_to_basket_and_added_to_item_stats()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'product_id' => $this->faker->numberBetween(1, 5)
        ];

        $this->post('/api/basket', $attributes)->assertStatus(200);

        $this->assertDatabaseHas('basket_items', $attributes);
        $this->assertDatabaseHas('item_stats', $attributes);

        $this->get('/api/basket')->assertSee($attributes['product_id']);
    }

    /** @test */
    public function a_product_can_be_removed_or_purchased_from_basket_and_added_to_item_stats()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'product_id' => $this->faker->numberBetween(1, 5)
        ];

        $this->post('/api/basket', $attributes)->assertStatus(200);

        $item = Basket_item::latest()->first()->toArray();

        //Item Purchased
        $this->delete('/api/basket/',['ids' => [85, 86, $item['id']], 'stat_type' => 'checkout'])->assertStatus(200);

        //Item Removed
//        $this->delete('/api/basket/',['ids' => [85, 86, $item['id']]])->assertStatus(200);

        $this->assertDatabaseHas('item_stats', $attributes);
    }

    /** @test */
    public function all_stats_can_be_viewed()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'product_id' => 1,
            'addedCount' => 35,
            'removedCount' => 10,
            'purchasedCount' => 6,
        ];

        $this->assertDatabaseHas('item_stats', $attributes);

        $this->get('/api/sales/stats')->assertSee($attributes);
    }

}
