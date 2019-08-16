<?php

namespace Tests\Feature;

use App\Contato;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class ContatoTest extends TestCase
{

	use DatabaseTransactions;
   

    /** @test */
    public function user_can_create_a_contato()
    {
    	$contato = factory(Contato::class)->make();

    	$this->post('contato', $contato->toArray());

    	$this->assertEquals(1, Contato::count());


    }

    /** @test */
    public function user_can_edit_a_contato()
    {
    	$contato = factory(Contato::class)->create();

    	$this->put('contato/' . $contato->id , ['nome' => 'Maria'] );

    	$this->assertEquals('Maria', Contato::find($contato->id)->nome);
    }

    /** @test */
    public function user_can_delete_a_contato()
    {
    	$contato = factory(Contato::class)->create();

    	$this->delete('contato/' . $contato->id);

    	$this->assertEquals(0, Contato::count());
    }

    /** @test */
    public function user_can_read_a_contato()
    {
    	$contatos = factory(Contato::class, 20)->create();

    	$response = $this->get('contato');

    	$this->assertEquals(20, count($response->json()));
    	
    }
}
