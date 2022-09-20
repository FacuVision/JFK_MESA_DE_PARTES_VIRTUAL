<?php

namespace Tests\Feature;

use App\Models\Secretary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;


class SecretaryTest extends TestCase
{

     /**@test */
    public function test_a_secreatary_has_many_proceding()
    {
        $secretary = new  Secretary();
        $this->assertInstanceOf(Collection::class, $secretary->anotations);
    }

}
