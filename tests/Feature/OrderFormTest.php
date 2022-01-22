<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderFormTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testOrderFormAvailable()
    {   // работа формы добавления
        $response = $this->get(route('order.index'));

        $response->assertStatus(200);
    }

    public function testOrderFormCreated()
    {   // работа формы добавления
        $responseData = [
            'name' => 'user',
            'phone' => '546546464',
            'email' => 'test@gmail.ru',
            'source' => 'source1'
        ];
        $response = $this->post(route('order.store'), $responseData );
        $response->assertSeeText("Заказ");

//        $response = $this->post(route('order.store'), $responseData );
//        $response->assertJson($responseData);
    }

    public function testOrderFormCreatedNoText()
    {   // работа формы добавления
        $responseData = [
            'name' => 'user',
            'phone' => '546546464',
            'email' => 'test@gmail.ru',
            'source' => 'source1'
        ];
        $response = $this->post(route('order.store'), $responseData );
        $response->assertDontSeeText("text");
    }


    public function testOrderFormViewCanBeRendered()
    {
        $view = $this->view('order.form');
        $view->assertSee('Имя');
    }

    public function testViewOrderFormWasReturnedRoute()
    {
        $response = $this->get(route('order.index'));
        $response->assertViewIs('order.form');
    }

    public function testHasNoValidationErrors()
    {
        $responseData = [
            'name' => 'user',
            'phone' => '546546464',
            'email' => 'test@gmail.ru',
            'source' => 'source1'
        ];
        $response = $this->post(route('order.store'), $responseData );
        $response->assertSessionHasNoErrors();
    }

}
