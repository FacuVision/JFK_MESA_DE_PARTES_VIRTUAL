<div>
    <h4>Generales</h4>

    {{-- VISTA GENERAL DEL ADMIN --}}
    <div class="row">
        <div class="col">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{ $array_users['users'] }}</h3>
                    <p>Usuarios Registrados en total</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    Ver mas <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $array_users['secretaries'] }}</h3>
                    <p>Secretarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
                <a href="{{ route('admin.secretaries.index') }}" class="small-box-footer">
                    Ver mas <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>{{ $array_users['aplicants'] }}</h3>
                    <p>Solicitantes Registrados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
                <a href="{{ route('admin.aplicants.index') }}" class="small-box-footer">
                    Ver mas <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>
    @can('secretaries.procedings.destroy')
        <div class="row">
            <div class="col">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de documentos Recibidos</span>
                        <span class="info-box-number">{{ $array_documentos['enviados'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de documentos atendidos</span>
                        <span class="info-box-number">{{ $array_documentos['respondidos'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Sales
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="card-body">
                    <div class="chart">
                      <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
            </div><!-- /.card-body -->
        </div>

    @endcan


    @can('secretaries.archivate.procedings.index')
        {{-- VISTA GENERAL DEL SECRETARIO --}}
        @if ($secretario_array_documentos != null)
            <h4>Específicos</h4>

            <div class="row">
                <div class="col">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tus documentos Recibidos</span>
                            <span class="info-box-number">{{ $secretario_array_documentos['secretary_enviados'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tus documentos atendidos</span>
                            <span
                                class="info-box-number">{{ $secretario_array_documentos['secretary_respondidos'] }}</span>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    @endcan





</div>
