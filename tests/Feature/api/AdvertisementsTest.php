<?php

namespace Tests\Feature\api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdvertisementsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;
    /** @test */
    public function making_an_api_advertisement_index_request(): void
    {

        $response = $this->get('/api/advertisements');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);
    }

    /** @test */
    public function making_an_api_advertisements_store_request_loged_in(): void
    {
        $response = $this->postJson('/api/login', [
            "email" => "user@example.com",
            'password' => 'factoria',
        ]);

        $this->assertAuthenticatedAs(Auth::user());


        $response = $this->postJson('/api/advertisements', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $this->assertDatabaseHas('advertisements', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }

    /** @test */
    public function making_an_api_advertisements_store_request_not_loged_in(): void
    {

        $response = $this->postJson('/api/advertisements', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $this->assertDatabaseMissing('advertisements', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $response
            ->assertStatus(401);
    }

    /** @test */
    public function making_an_api_advertisements_update_request_loged_in(): void
    {
        $response = $this->postJson('/api/login', [
            "email" => "user@example.com",
            'password' => 'factoria',
        ]);

        $this->assertAuthenticatedAs(Auth::user());

        $response = $this->put('/api/advertisements/1', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $this->assertDatabaseHas('advertisements', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);
        $response
            ->assertStatus(200);
    }

    /** @test */
    public function making_an_api_advertisements_update_request_not_loged_in(): void
    {

        $response = $this->put('/api/advertisements/1', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $this->assertDatabaseMissing('advertisements', [
            "name" => "title",
            "category" => "fullstack",
            "image" => "default.png",
            "description" => "description",
            "price" => 200
        ]);

        $response
            ->assertStatus(500);
    }

    /** @test */
    public function making_an_api_advertisements_delete_request_loged_in(): void
    {
        $response = $this->postJson('/api/login', [
            "email" => "user@example.com",
            'password' => 'factoria',
        ]);

        $this->assertAuthenticatedAs(Auth::user());

        $response = $this->delete('/api/advertisements/1', []);

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function making_an_api_advertisements_delete_request_not_loged_in(): void
    {

        $response = $this->delete('/api/advertisements/1', []);

        $response
            ->assertStatus(500);
    }
}
