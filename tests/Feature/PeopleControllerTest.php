<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function itListsPeople(): void
    {
        $response = $this->get('/api/people');

        $response->assertStatus(200);
        $this->assertCount(10, $response->json('data'));
    }

      /** @test */
      public function itCreatesPerson()
      {
        $response = $this->post('/api/people', [
            'civility_id' => 1,
            'last_name' => 'Premier nom',
            'first_name' => 'Premier prénom',
            'email' => 'mail@mail.com',
            'phone' =>'0666666666',
        ]);


        $response->assertStatus(201);
      }


      /** @test */
public function itUpdatesPerson()
{
  $this->seed();
  $person = Person::first();

  $response = $this->put('/api/people/' . $person->id, [
    'civility_id' => 1,
    'last_name' => 'Nouveau nom',
    'first_name' => 'Prénom édité',
    'email' => 'tfyeztf@mail.com',
    'phone' =>'0667667666',
]);
  
$updatedPerson = Person::find($person->id);

$response->assertOk();
$this->assertEquals('Nouveau nom', $updatedPerson->nom);
}
}
