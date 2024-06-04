<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Insurance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\InsuranceController;
use Illuminate\Http\Request;
class InsuranceControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUpdate(): void
    {
        $controller = new InsuranceController();

        $request = new Request([
            'cif' => '12345678',
            'name' => 'prueba',
            'address' => 'calle de prueba',
            'price' => 10,
        ]);

        $insurance = Insurance::storeInsurance($request);

        $id = $insurance->_id;

        $updatedData = new Request([
            'name' => 'Cambiamos el nombre',
            'address' => 'Cambiamos la calle',
            'price' => 100000000,
        ]);

        $response = $controller->update($updatedData, $id);

        $this->assertDatabaseHas('Insurances', [
            '_id' => $id,
            'cif' => $insurance->cif,
            'name' => $updatedData['name'],
            'address' => $updatedData['address'],
            'price' => $updatedData['price'],
            'isActive' => true,
        ]);
    }
}
