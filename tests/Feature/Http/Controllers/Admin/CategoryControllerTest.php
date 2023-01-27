<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexSuccessStatus(): void
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);
    }

    public function testCreateSuccessStatus(): void
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(200);
    }

    public function testCreateSaveSuccessData(): void
    {
        $data = [
            'title' => \fake()->jobTitle(),
            'author' => \fake()->userName(),
            'discription' => \fake()->text(100),
        ];

        $response = $this->post(route('admin.categories.store'), $data);

        $response->assertStatus(200)
            ->json($data);
    }

    public function testValidateTitleData(): void
    {
        $data = [
            'author' => \fake()->userName(),
            'discription' => \fake()->text(100),
        ];

        $response = $this->post(route('admin.categories.store'), $data);
        $response->assertRedirect('http://localhost');
    }

    public function testAssertSeeData(): void
    {
        $data = [
            'title' => \fake()->jobTitle(),
            'discription' => \fake()->text(100),
        ];

        $response = $this->post(route('admin.categories.store'), $data);

        $response->assertSee('title', $data = true);
    }

}
