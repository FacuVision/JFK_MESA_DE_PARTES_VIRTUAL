<?php

namespace Tests\Feature;

use App\Models\Departament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;


class DepartamentTest extends TestCase
{
    /** @test */
    public function a_departament_has_many_provinces()
    {
        $departament = new  Departament();
        $this->assertInstanceOf(Collection::class, $departament->provinces);
    }
}
