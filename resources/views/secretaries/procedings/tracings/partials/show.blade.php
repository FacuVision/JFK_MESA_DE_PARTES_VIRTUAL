<div class="modal fade bd-example-modal-lg" id="showModal{{ $proceding->id }}" data-modal-index="1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles del expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-row mb-4">


                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="code">Codigo</label>
                        <input type="text" class="form-control form-control-sm" id="code" value="{{ $proceding->code }}"
                            readonly>
                    </div>
                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="foly">Numero de Folio</label>
                        <input type="text" class="form-control form-control-sm" id="foly" value="{{ $proceding->n_foly }}"
                            readonly>
                    </div>
                    <!-- Referencia es "S/N" por defecto, esto estara activo siempre y cuando se haga referencia a un documento cuando se haya hecho la subsanacion-->
                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="reference">Referencia</label>
                        <input type="text" class="form-control form-control-sm" id="reference"
                            value="{{ $proceding->reference }}" readonly>
                    </div>

                    <div class="form-group-sm col-md-6">
                        <label class="col-form-label col-form-label-sm" for="lastname">Apellidos del Remitente</label>
                        <input type="text" class="form-control form-control-sm" id="lastname"
                            value="{{ $proceding->aplicant->user->profile->lastname }}" readonly>
                    </div>
                    <div class="form-group-sm col-md-6">
                        <label class="col-form-label col-form-label-sm" for="name">Nombres del Remitente</label>
                        <input type="text" class="form-control form-control-sm" id="name"
                            value="{{ $proceding->aplicant->user->profile->name }}" readonly>
                    </div>



                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="type_document">Tipo de Documento</label>
                        <input type="text" class="form-control form-control-sm" id="type_document"
                            value="{{ $proceding->aplicant->user->profile->type_document->name }}" readonly>
                    </div>
                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="document_number">Numero de
                            Documento</label>
                        <input type="text" class="form-control form-control-sm" id="document_number"
                            value="{{ $proceding->aplicant->user->profile->document_number }}" readonly>
                    </div>
                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="phone">Numero de Celular</label>
                        <input type="text" class="form-control form-control-sm" id="phone"
                            value="{{ $proceding->aplicant->user->profile->phone }}" readonly>
                    </div>


                    <div class="form-group-sm col-md-6">
                        <label class="col-form-label col-form-label-sm" for="office">Oficina Destino</label>
                        <input type="text" class="form-control form-control-sm" id="office"
                            value="{{ $proceding->office->name }}" readonly>
                    </div>
                    @php
                        $fecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $proceding->created_at)->format('d-m-Y H:i:s');
                    @endphp
                    <div class="form-group-sm col-md-6">
                        <label class="col-form-label col-form-label-sm" for="created_at">Fecha de Envio</label>
                        <input type="text" class="form-control form-control-sm" id="created_at"
                            value="{{ $fecha }}" readonly>
                    </div>


                    <div class="form-group-sm col-md-12">
                        <label class="col-form-label col-form-label-sm" for="type_proceding">Tipo de Expediente</label>
                        <input type="text" class="form-control form-control-sm" id="type_proceding"
                            value="{{ $proceding->type_proceding->name }}" readonly>
                    </div>


                    <div class="form-group-sm col-md-12">
                        <label class="col-form-label col-form-label-sm" for="title">Titulo</label>
                        <input type="text" class="form-control form-control-sm" id="title" value="{{ $proceding->title }}"
                            readonly>
                    </div>


                    <div class="form-group-sm col-md-12">
                        <label class="col-form-label col-form-label-sm" for="content">Contenido</label>
                        <textarea type="textarea" class="form-control form-control-sm" id="content" readonly>{{ $proceding->content }}</textarea>
                    </div>


                </div>

                <div class="row text-center">
                    <div class="col-sm">
                        <label class="col-form-label col-form-label-sm" for="content">Principal</label>
                    </div>
                    <div class="col-sm">
                        <label class="col-form-label col-form-label-sm" for="content">Anexos</label>
                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                @if (isset($proceding->documents[0]->url))
                                    <a href="{{ Storage::url($proceding->documents[0]->url) }}" target="blank_">
                                        <span style="font-size: 3em"><i style="color:Tomato" class="fas fa-file-pdf"></i></span>
                                    </a>
                                @else
                                    <div class="form-group-sm col-md-12">
                                        <a>-</a>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                @if (isset($proceding->documents[1]->url))
                                    <a href="{{ Storage::url($proceding->documents[1]->url) }}" target="blank_"><span style="font-size: 3em"><i
                                            style="color:Tomato" class="fas fa-file-pdf"></i></span></a>
                                @else
                                    <div class="form-group-sm col-md-12">
                                        <a><span style="font-size: 3em"><i style="color:gray" class="fas fa-file-pdf"></i></span></a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <div class="modal-footer">
                <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>
</div>
