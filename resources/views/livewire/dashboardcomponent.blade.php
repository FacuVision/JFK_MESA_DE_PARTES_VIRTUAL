<div>
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
        <h4>Conteo General</h4>
        <p>Se muestra la cantidad de documentos pendientes por atender y los que ya fueron atendidos <strong>(todas las
                areas)</strong></p>

        <div class="row">
            <div class="col">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de documentos por atender</span>
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
                    Historial de Documentos: @php echo date('Y'); @endphp
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        {{-- <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li> --}}
                        <li class="nav-item m-2">
                            <span class="badge badge-primary">Atendidos</span>
                            <span class="badge badge-secondary">Enviados</span>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="card-body">
                    <div class="chart">
                        <canvas id="areaChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div><!-- /.card-body -->
        </div>

        <h4>Ratio de rendimiento</h4>
        <p>Se muestra los porcentajes de avance segun la cantidad de documentos atendidos sobre la de los recibidos</p>

        <div class="row">
            <div class="col">
                <div class="info-box">

                    <div class="info-box-content">
                        <span class="info-box-text">Leyenda</span>

                        <div class="row text-center">
                            <div class="col">
                                <span class="badge badge-danger text-md mt-2"> 0% - 25% (rendimiento bajo)</span>
                            </div>
                            <div class="col">
                                <span class="badge badge-warning text-md mt-2"> 26% - 65% (rendimiento medio)</span>
                            </div>
                            <div class="col">
                                <span class="badge badge-success text-md mt-2"> 66% - 100% (rendimiento alto)</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row text-center">

            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Enero</span>
                        <div class="container">
                            <input type="text" value="5" id="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Febrero</span>
                        <div class="container">
                            <input type="text" value="5" id="2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Marzo</span>
                        <div class="container">
                            <input type="text" value="5" id="3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Abril</span>
                        <div class="container">
                            <input type="text" value="5" id="4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Mayo</span>
                        <div class="container">
                            <input type="text" value="5" id="5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Junio</span>
                        <div class="container">
                            <input type="text" value="5" id="6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Julio</span>
                        <div class="container">
                            <input type="text" value="5" id="7">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Agosto</span>
                        <div class="container">
                            <input type="text" value="5" id="8">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Septiembre</span>
                        <div class="container">
                            <input type="text" value="5" id="9">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Octubre</span>
                        <div class="container">
                            <input type="text" value="5" id="10">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Noviembre</span>
                        <div class="container">
                            <input type="text" value="5" id="11">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="info-box">
                    <div class="info-box-content">
                        <span class="info-box-text">Diciembre</span>
                        <div class="container">
                            <input type="text" value="5" id="12">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4>Satisfacción del Cliente</h4>
        <p>Se muestra los resultados de las encuentas tomando en cuenta los 3 principales aspectos: Usabilidad,
            Funcionalidad y Accesibilidad</p>
            <div class="col">
                <div class="info-box">
                    <div class="info-box-content">
                            <h3 class="card-title">Personas que respondieron : <strong>{{$total["respuestas"]}}</strong></h3>
                    </div>
                </div>
            </div>
        <div class="row text-center">


            <!-- PIE CHART -->
            <div class="card col-sm-6">
                <div class="card-header">
                    <h3 class="card-title">¿Qué tanto considera la facilidad de uso del sistema a comparación de la manera
                        tradicional?</h3>
                </div>
                <div class="card-body">
                    <canvas id="usa1"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- PIE CHART -->
            <div class="card col-sm-6">
                <div class="card-header">
                    <h3 class="card-title">¿Considera que la atención es mucho más rápida?</h3>
                </div>
                <div class="card-body">
                    <canvas id="usa2"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- PIE CHART -->
            <div class="card col-sm-6">
                <div class="card-header">
                    <h3 class="card-title">¿El sistema responde con velocidad en sus procedimientos?</h3>
                </div>
                <div class="card-body">
                    <canvas id="fun1"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- PIE CHART -->
            <div class="card col-sm-6">
                <div class="card-header">
                    <h3 class="card-title">¿El sistema descarga correctamente sus reportes en los formatos disponibles?</h3>
                </div>
                <div class="card-body">
                    <canvas id="fun2"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- PIE CHART -->
            <div class="card col-sm-6">
                <div class="card-header">
                    <h3 class="card-title">¿El sistema puede usarlo con normalidad en su móvil?</h3>
                </div>
                <div class="card-body">
                    <canvas id="acc1"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- PIE CHART -->
            <div class="card col-sm-6">
                <div class="card-header">
                    <h3 class="card-title">¿Considera muy util poder hacer el seguimiento de sus expedientes enviados?</h3>
                </div>
                <div class="card-body">
                    <canvas id="acc2"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    @endcan




    @can('secretaries.archivate.procedings.index')
        {{-- VISTA GENERAL DEL SECRETARIO --}}
        @if ($secretario_array_documentos != null)
            <h4>Específicos</h4>
            <p>Se muestra la cantidad de documentos pendientes por atender y los que ya fueron atendidos <strong>(en tu
                    area)</strong></p>

            <div class="row">
                <div class="col">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tus documentos por atender</span>
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
