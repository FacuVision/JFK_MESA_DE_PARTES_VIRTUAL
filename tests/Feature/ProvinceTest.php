<?php

namespace Tests\Feature;

use App\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;


class ProvinceTest extends TestCase
{
    /** @test */
    public function a_province_has_many_districts()
    {
        $province = new  Province();
        $this->assertInstanceOf(Collection::class, $province->districts);
    }
}
