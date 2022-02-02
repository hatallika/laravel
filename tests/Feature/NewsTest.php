<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\News;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewsAvailable()
    { // проверяем доступный список всех новостей на сайте
        $response = $this->get('/news');

        $response->assertStatus(200);
    }

    public function testNewsShow()
    {   //проверяем конкретную новость, что открывается
        $response = $this->get(route('news.show', ['news' => '1']));

        $response->assertStatus(200);
    }

    public function testNewsAdminAvailable()
    {   //проверяем список админских новостей
        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
    }

    public function testNewsCreateAdminAvailable()
    {   // работа формы добавления
        $response = $this->get(route('admin.news.create'));

        $response->assertStatus(200);
    }

    public function testNewsAdminCreated()
    {
        $category = Category::factory()->create();
        $responseData = News::factory()->definition();
        $responseData = $responseData + ['category_id' => $category->id];

        $response = $this->post(route('admin.news.store'), $responseData);

        //$response->assertJson($responseData);
        $response->assertStatus(302);

    }

    public function testViewNewsHasDataList()
    {

        $response = $this->get(route('news.index'));

        $response->assertViewHasAll(['newsList']);
    }

    public function testViewAdminNewsCreateContainsData()
    {
        $categories = Category::all();

        $response = $this->get(route('admin.news.create'));
        $response->assertViewHas('categories', $categories);
    }






}
