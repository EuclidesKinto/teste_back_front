<?php
use App\Models\Budget;
use App\Models\Seller;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(RefreshDatabase::class);
uses(WithFaker::class);

it('can make several budget', function () {

    $budgets = Budget::factory(5)->create();

    $response = $this->getJson('/api/v1/budgets');
    $response->assertOk();
    expect($budgets)->toHaveCount(5);
});

it('should return 422 if name is missing', function () {
    $this->postJson(route('budgets.store'), [
        'client' => 'client',
        'description' => 'description',
    ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
})->with([
    '',
    null
]);

it('can create a budget', function () {
    $budget =  [
        'client' => $this->faker->name,
        'description' => $this->faker->paragraph(1),
        'price' => $this->faker->numberBetween($min = 0, $max = 100),
        'seller_id' => Seller::factory()->create()->id,
    ];


    $response = $this->withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ])->postJson(route('budgets.store'), $budget);

    $response->assertStatus(Response::HTTP_CREATED);
    $this->assertDatabaseHas('budgets', $budget);
});

it('can show a budget', function () {

    $budget = Budget::factory()->create(['client' => 'Codificar']);

    $response = $this->getJson('/api/v1/budgets/' . $budget->id);

    $response->assertOk();
    expect($budget)
        ->client->toBe('Codificar')
        ->body->toBeNull();
});

it('can show a budget status 404 ', function () {

    $budget = Budget::factory()->create(['client' => 'Codificar']);

    $response = $this->getJson('/api/v1/budgets/' . $budget->id+1);

    $response->assertStatus(Response::HTTP_NOT_FOUND);
    expect($budget)
        ->client->not->toBeArray()
        ->body->toBeNull();
});

it('can update a budget', function () {
    $budget = Budget::factory()->create();

    $budgetData = [
        'client' => 'Empresa B',
        'description' => 'Serviços de desenvolvimento mobile',
        'price' => 60,
        'seller_id' => 1,
    ];

    $response = $this->withHeaders([
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ])->putJson('/api/v1/budgets/' . $budget->id, $budgetData);

//    dd($budget, $budgetData, $response);
    $response->assertStatus(Response::HTTP_OK);
    $this->assertDatabaseHas('budgets', $budgetData);
});

it('can delete a budget', function () {
    $budget = Budget::factory()->create();

    $response = $this->deleteJson('/api/v1/budgets/' . $budget->id);

    $response->assertStatus(Response::HTTP_NO_CONTENT);
    expect($budget)->body->toBeNull();
});
