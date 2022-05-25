<div class="modal fade bd-example-modal-lg" id="anotationModal{{ $proceding->id }}" data-modal-index="4"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anotaciones del expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @php
                    $cont = 1
                @endphp

                @foreach ($proceding->anotations as $anotation)

                <div class="card">
                    <div class="card-header bg-light">
                        <strong>({{$cont}}) Remitente </strong>
                        {{$anotation->secretary->user->profile->name}} {{$anotation->secretary->user->profile->lastname}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col"><strong>Id: </strong><br> {{$anotation->id}}</div>
                            <div class="col"><strong>Titulo: </strong><br> {{$anotation->title}}</div>
                            <div class="col"><strong>Oficina: </strong><br> {{$anotation->office->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col"><strong>Descripcion: </strong><br> {{$anotation->description}}</div>
                        </div>
                    </div>
                </div>
                @php
                   $cont++
                @endphp
                @endforeach

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>
