<div class="modal fade respuesta" id="subsanaModal{{ $proceding->id }}" data-modal-index="5"
    aria-labelledby="exampleModalLabel" data-focus-on="input:first" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitar subsanacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::model($proceding, ['route' => ['secretary.procedings.subsanar_expediente', $proceding], 'method' => 'PUT']) !!}

                <div class="form-row">
                    <div class="form-group-sm col-md-12">
                        {!! Form::label('Titulo', 'Titulo', ['class' => 'col-form-label col-form-label-sm']) !!}
                        {!! Form::text('titulo', null, ['class' => 'form-control form-control-sm']) !!}
                    </div>
                    <div class="form-group-sm col-md-12">
                        {!! Form::label('Contenido', 'Contenido', ['class' => 'col-form-label col-form-label-sm']) !!}
                        {!! Form::textarea('contenido', null, ['class' => 'form-control form-control-sm']) !!}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-dark" data-dismiss="modal">Cerrar</a>
                {!! Form::submit('Solicitar subsanacion', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

