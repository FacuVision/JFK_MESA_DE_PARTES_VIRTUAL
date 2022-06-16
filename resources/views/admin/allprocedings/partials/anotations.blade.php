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



@if ($proceding->anotations->count() != 0)


                @foreach ($proceding->anotations as $anotation)

                <div class="card">
                    <div class="card-header bg-secondary">
                        <strong>({{$cont}}) Remitente </strong>
                        {{$anotation->secretary->user->profile->name}} {{$anotation->secretary->user->profile->lastname}}
                    </div>
                    <div class="card-body">

                        @php
                            $fecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $anotation->created_at)->format('d-m-Y H:i:s');
                        @endphp
                        <div class="form-row mb-4">

                            <div class="form-group-sm col-md-1">
                                <label class="col-form-label col-form-label-sm" for="code">Codigo</label>
                                <input type="text" class="form-control form-control-sm"
                                    value="{{ $anotation->id}}" readonly>
                            </div>
                            <div class="form-group-sm col-md-11">
                                <label class="col-form-label col-form-label-sm" for="foly">Título</label>
                                <input type="text" class="form-control form-control-sm"
                                value="{{ $anotation->title }}" readonly>
                            </div>
                            <div class="form-group-sm col-md-6">
                                <label class="col-form-label col-form-label-sm" for="foly">Oficina</label>
                                <input type="text" class="form-control form-control-sm"
                                value="{{ $anotation->office->name }}" readonly>
                            </div>
                            <div class="form-group-sm col-md-6">
                                <label class="col-form-label col-form-label-sm" for="foly">Fecha de Envío</label>
                                <input type="text" class="form-control form-control-sm"
                                value="{{ $fecha }}" readonly>
                            </div>
                            <div class="form-group-sm col-md-12">
                                <label class="col-form-label col-form-label-sm" for="foly">Contenido</label>
                                <textarea readonly class="form-control form-control-sm" cols="30" rows="5">{{ $anotation->description }}</textarea>
                            </div>
                        </div>
                    </div>


                </div>
                @php
                   $cont++
                @endphp
                @endforeach
@else
                    <input disabled class="form-control" type="text" value="Este expediente no cuenta con incidencias aún">
@endif

@if ($proceding->answers->count() != 0)
<hr>
            <div class="card">
                <div class="card-header">
                    <h5><strong>Respuestas</strong></h5>
                    <span>Las respuestas pueden ser anotaciones pero de subsanacion o notificaciones finales de aprobacion</span>
                </div>
                <div class="card-body">
                    @foreach ($proceding->answers as $respuesta)

                    @php
                    $fecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $respuesta->created_at)->format('d-m-Y H:i:s');
                    @endphp

                    <div class="form-row mb-4">

                        <div class="form-group-sm col-md-2">
                            <label class="col-form-label col-form-label-sm" for="code">Codigo</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $respuesta->id }}" readonly>
                        </div>
                        <div class="form-group-sm col-md-10">
                            <label class="col-form-label col-form-label-sm" for="foly">Título</label>
                            <input type="text" class="form-control form-control-sm"
                            value="{{ $respuesta->title }}" readonly>
                        </div>
                        <div class="form-group-sm col-md-12">
                            <label class="col-form-label col-form-label-sm" for="foly">Contenido</label>
                            <textarea readonly class="form-control form-control-sm" cols="30" rows="5">{{ $respuesta->content }}</textarea>
                        </div>
                        <div class="form-group-sm col-md-6">
                            <label class="col-form-label col-form-label-sm" for="foly">Estado de Leído</label>
                            @if ($respuesta->title==0)
                            <input type="text" class="form-control form-control-sm" value="Si" readonly>
                            @else
                            <input type="text" class="form-control form-control-sm" value="No" readonly>
                            @endif
                        </div>
                        <div class="form-group-sm col-md-3">
                            <label class="col-form-label col-form-label-sm" for="code">Fecha de envío</label>
                            <input type="text" class="form-control form-control-sm"
                                value="{{ $fecha }}" readonly>
                        </div>
                        <div class="form-group-sm col-md-3">
                            <label class="col-form-label col-form-label-sm red" for="code">Tipo de respuesta</label>
                            @if ($respuesta->answer_type==1)
                            <input type="text" class="form-control form-control-sm" value="Se solicitó subsanación" readonly>

                            @else
                            <input type="text" class="form-control form-control-sm" value="Notificacion final" readonly>
                            @endif
                        </div>

                    </div>









{{--
                        <div class="form-row mb-4">
                            <input type="text" class="form-control" disabled>
                            {{$respuesta->id}}
                            <div class="form-group-sm col-md-6"><strong>Titulo: </strong><br> {{$respuesta->title}}</div>
                            <div class="form-group-sm col-md-6"><strong>Contenido: </strong><br> {{$respuesta->content}}</div>
                            <div class="form-group-sm col-md-6"><strong>Estadod e leído: </strong><br> {{$respuesta->read_status}}</div>
                        </div> --}}
                    @endforeach
                </div>
            </div>
@else
            <input disabled class="form-control" type="text" value="Este expediente no cuenta con respuestas aún">
@endif

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>
