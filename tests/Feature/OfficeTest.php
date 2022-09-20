<?php

namespace Tests\Feature;

use App\Models\Office;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;


class OfficeTest extends TestCase
{
    /**@test */
        //una oficina puede aparecer en muchos resgistros de un expediente
    public function test_a_office_has_many_proceding()
    {
        $office = new  Office();
        $this->assertInstanceOf(Collection::class, $office->procedings);
    }

    public function test_a_office_has_many_anotations()
    {
        $office = new  Office();
        $this->assertInstanceOf(Collection::class, $office->anotations);
    }

}
