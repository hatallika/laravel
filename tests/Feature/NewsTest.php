<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
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
        $response = $this->get(route('news.show', ['id' => mt_rand(1, 10)]));

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
    {   //проверим создание новости на возврат json
        $responseData = [
            'title' => 'Some title',
            'author' => 'Admin',
            'status' => 'draft',
            'description' => 'Some text'
        ];

        $response = $this->post(route('admin.news.store'), $responseData );

        $response->assertJson($responseData);
        $response->assertStatus(200);
    }


}
