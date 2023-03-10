<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_product_can_be_added_to_basket()
    {
//        $this->withoutExceptionHandling();

        $attributes = [
            'product_id' => $this->faker->numberBetween(1, 5)
        ];

        $this->post('/basket', $attributes);

        $this->assertDatabaseHas('basket_items', $attributes);
    }
}
