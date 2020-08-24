<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test from insert customers method
     *
     * @return void
     */
    public function testCheckIfCustomerIsStored()
    {
        $customerData = [
            'name' => 'Customer Name Test',
            'email' => 'user@email.com',
            'phone' => '11912345678',
            'birth_date' => '2020-01-01',
            'address' => 'Customer address, 123',
            'complement' => 'Complement',
            'district' => 'downtown',
            'zip_code' => '12345000'
        ];
        
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest'
        ])->json('POST', '/api/v2/customers', $customerData);
        
        $response
            ->assertJsonStructure([
                'name',
                'email',
                'phone',
                'birth_date',
                'address',
                'district',
                'zip_code'
            ])
            ->assertStatus(201);        
    } 
    
    /**
     * Test from view customers method
     *
     * @return void
     */
    public function testCheckIfCustomerIsReturned()
    {
        $customer = Customer::first();
        $response = $this->get('/api/v2/customers/' . $customer->id);
                
        $response
            ->assertJsonStructure([
                'name',
                'email',
                'phone',
                'birth_date',
                'address',
                'complement',
                'district',
                'zip_code'
            ])
            ->assertStatus(200);        
    }  
    
    /**
     * Test from update customers method
     *
     * @return void
     */
    public function testCheckIfCustomerIsUpdated()
    {
        $customer = Customer::first();
        $customerData = [
            'name' => 'User Name Test',
            'email' => 'updated_user@email.com',
            'phone' => '11912345678',
            'birth_date' => '2020-01-01',
            'address' => 'User address, 123',
            'complement' => 'Complement',
            'district' => 'downtown',
            'zip_code' => '12345000'
        ];
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest'
        ])->json('PUT', '/api/v2/customers/' . $customer->id, $customerData);

        $response
            ->assertJsonStructure([
                'name',
                'email',
                'phone',
                'birth_date',
                'address',
                'complement',
                'district',
                'zip_code'
            ])
            ->assertStatus(200);        
    } 
    

    /**
     * Test from list all customers method
     *
     * @return void
     */
    public function testCheckIfAllCustomersAreReturned()
    {
        $response = $this->get('/api/v2/customers');
                
        $response
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'email',
                    'phone',
                    'birth_date',
                    'address',
                    'complement',
                    'district',
                    'zip_code'
                ]
            ])
            ->assertStatus(200);        
    }  

    /**
     * Test from delete customers method
     *
     * @return void
     */
    public function testCheckIfCustomerIsDeleted()
    {
        $customer = Customer::first();
        $response = $this->delete('/api/v2/customers/' . $customer->id);

        $response
            ->assertStatus(204);
    }    
}
