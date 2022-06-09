<div class="modal fade respuesta" id="answerModal{{ $proceding->id }}" data-modal-index="2"
    aria-labelledby="exampleModalLabel" data-focus-on="input:first" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar Respuesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- {!! Form::open(['method' => 'POST', 'route' => 'secretaries.procedings.store']) !!} --}}

                {!! Form::open(['method' => 'POST', 'route' => 'secretaries.procedings.store', 'method' => 'POST', 'files' => true]) !!}

                {!! Form::hidden('procedingid', $proceding->id) !!}
                <div class="form-row">
                    <div class="form-group-sm col-md-12">
                        {!! Form::label('title', 'Titulo', ['class' => 'col-form-label col-form-label-sm']) !!}
                        {!! Form::text('title', null, ['class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group-sm col-md-12">
                        {!! Form::label('content', 'Contenido', ['class' => 'col-form-label col-form-label-sm']) !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control form-control-sm']) !!}
                    </div>

                    <div class="form-group-sm col-md-12">
                        {!! Form::label('Archivo', 'Selecciona archivo', ['class' => 'col-form-label col-form-label-sm']) !!}
                        <input type="file" lang="es" name="answer_pdf" class="form-control">
                          </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-dark" data-dismiss="modal">Cerrar</a>
                    {!! Form::submit('Enviar', ['class' => 'btn btn-success']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

