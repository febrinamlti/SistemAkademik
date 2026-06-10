<?php

namespace Tests\Unit;

use App\Models\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $customer = new Customer([
            'first_name' => 'Marc',
            'last_name' => 'Marquez',
            'email' => 'marquez@example.com'
        ]);

        $this->assertEquals('Marc Marquez', $customer->fullName());
    }
}