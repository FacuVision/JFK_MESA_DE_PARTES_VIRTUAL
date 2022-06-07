<div class="modal fade" id="deriveModal{{ $proceding->id }}" data-modal-index="3"
    aria-labelledby="exampleModalLabel" data-focus-on="input:first" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Derivar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($proceding, ['route' => ['secretaries.procedings.update', $proceding], 'method' => 'PUT']) !!}
                <div class="form-row">
                    <div class="form-group-sm col-md-12">
                        {!! Form::label('office', 'Seleccionar Oficina', ['class' => 'col-form-label col-form-label-sm']) !!}
                        {!! Form::select('office', $offices->pluck('name','id'), null, ['placeholder' => 'Elija Oficina...', 'class' => 'form-control']) !!}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-dark" data-dismiss="modal">Cerrar</a>
                {!! Form::submit('Derivar', ['class' => 'btn btn-warning']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
