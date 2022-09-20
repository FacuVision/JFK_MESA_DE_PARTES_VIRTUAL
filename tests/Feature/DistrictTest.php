<?php

namespace Tests\Feature;

use App\Models\District;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;


class DistrictTest extends TestCase
{
    /** @test */
    //un distrito puede aparecer en muchos profiles
    public function a_district_has_many_profiles()
    {
        $district = new  District();
        $this->assertInstanceOf(Collection::class, $district->profiles);
    }
}
