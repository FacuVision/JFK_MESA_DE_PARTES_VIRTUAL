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
                        <input type="text" class="form-control form-control-sm" id="code"
                            value="{{ $proceding->code }}" readonly>
                    </div>
                    <div class="form-group-sm col-md-4">
                        <label class="col-form-label col-form-label-sm" for="foly">Numero de Folio</label>
                        <input type="text" class="form-control form-control-sm" id="foly"
                            value="{{ $proceding->n_foly }}" readonly>
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
                    <div class="form-group-sm col-md-6">
                        <label class="col-form-label col-form-label-sm" for="created_at">Fecha de Envio</label>
                        <input type="text" class="form-control form-control-sm" id="created_at"
                            value="{{ $proceding->created_at }}" readonly>
                    </div>


                    <div class="form-group-sm col-md-12">
                        <label class="col-form-label col-form-label-sm" for="type_proceding">Tipo de Expediente</label>
                        <input type="text" class="form-control form-control-sm" id="type_proceding"
                            value="{{ $proceding->type_proceding->name }}" readonly>
                    </div>


                    <div class="form-group-sm col-md-12">
                        <label class="col-form-label col-form-label-sm" for="title">Titulo</label>
                        <input type="text" class="form-control form-control-sm" id="title"
                            value="{{ $proceding->title }}" readonly>
                    </div>


                    <div class="form-group-sm col-md-12">
                        <label class="col-form-label col-form-label-sm" for="content">Contenido</label>
                        <textarea type="textarea" class="form-control form-control-sm" id="content"
                            readonly>{{ $proceding->content }}</textarea>
                    </div>


                </div>
                <div class="card">
                    <div class="card-body text-center">

                        <div class="row">
                            <div class="col-sm">
                                <label class="col-form-label col-form-label-sm" for="content">Principal</label>
                            </div>
                            <div class="col-sm">
                                <label class="col-form-label col-form-label-sm" for="content">Anexos</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group-sm col-md-12">
                                    <span style="font-size: 3em;">
                                        <a href=""><i  style="color:Tomato" class="fas fa-file-pdf"></i></a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group-sm col-md-12">
                                    <span style="font-size: 3em;">
                                        <a href=""><i style="color:Tomato" class="fas fa-file-pdf"></i></a>
                                    </span>
                                 </div>
                            </div>
                        </div>




                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</a>
                {{-- <form action="{{ route('secretary.procedings.destroy', $proceding) }}"
                    method="post" class="formulario-eliminar">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Rechazar" class="btn btn-dark">
                </form> --}}
                <a href="{{ route('secretary.procedings.reject', $proceding) }}"
                    class="btn btn-dark btn-sm">Rechazar</a>
                <a href="{{ route('secretary.procedings.edit', $proceding) }}"
                    class="btn btn-danger btn-sm">Subsanar</a>
                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                    data-target="#deriveModal{{ $proceding->id }}">Derivar</a>
                <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#answerModal{{ $proceding->id }}">Dar Respuesta</a>
            </div>
        </div>
    </div>
</div>
