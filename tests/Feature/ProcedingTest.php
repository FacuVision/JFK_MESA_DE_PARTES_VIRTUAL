<?php

namespace Tests\Feature;

use App\Models\Proceding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;


class ProcedingTest extends TestCase
{

         //un expediente puede tener una a muchas respuestas
    public function test_a_proceding_has_many_answers()
    {
        $proceding= new Proceding();
        $this->assertInstanceOf(Collection::class, $proceding->answers);
    }

    //un expediente puede tener una a muchas anotaciones
    public function test_a_proceding_has_many_anotations()
    {
        $proceding= new Proceding();
        $this->assertInstanceOf(Collection::class, $proceding->anotations);
    }

    // Un procedimiento puede tener muchos documentos

    public function test_a_proceding_morph_many_documents()
    {
        $proceding= new Proceding();
        $this->assertInstanceOf(Collection::class, $proceding->documents);
    }

    
}
