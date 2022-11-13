<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reto Web Full-Stack</title>
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-5/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-6/css/all.min.css') }}">


        <link rel="stylesheet" href="{{ asset('plugins/css/retoweb.css') }}">
    </head>
    <body class="bg-dark">
        <div class="container-fluid my-3">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 ">
                    <div id="body-jugadores" class="card rgba-grey-slight z-depth-2">
                        <div class="card-body p-2">
                            <div class="card z-depth-2">
                                <div class="col-12">
                                    <div class="row card-header text-white py-1 px-3">
                                        <div class="m-2">
                                            <a class="px-3 btn btn-primary" href="{{route('crearPaciente')}}">Nuevo <i class="fa fa-plus text-yellow"></i></a>
                                        </div>
                                        <div class="card-body p-2 jugadores_wrapper">
                                            <div class="table-responsive-xl">
                                            <table id="jugadores" class="mt-2 table table-hover table-striped table-bordered nowrap dataTable " role='grid' style="width:100%" cellspacing="0">
                                                <thead class="">
                                                    <tr class="text-center align-middle">
                                                        <th class="py-2 pr-3">Reg</th>
                                                        <th>Nombre</th>
                                                        <th>Fecha Nac.</th>
                                                        <th>Edad</th>
                                                        <th>Sexo</th>
                                                        <th>Peso</th>
                                                        <th>Estatura</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    @foreach($pacientes as $key => $paciente)
                                                    @php
                                                        $fecha = new Carbon\Carbon($paciente->nfecha);
                                                        $edad = Carbon\Carbon::createFromDate($paciente->nfecha)->age;
                                                        if ($paciente->sexo == "M") $sexo = "Masculino";
                                                        else { $sexo = "Femenino"; }
                                                    @endphp
                                                    <tr class="text-center align-middle">
                                                        <td>{{$key + 1}}</td>
                                                        <td class="text-start"><a href="{{ route('editPaciente', $paciente->id) }}"> {{$paciente->nombre}}</a></td>
                                                        <td>{{$fecha->formatLocalized('%d/%m/%Y')}}</td>
                                                        <td>{{$edad}}</td>
                                                        <td>{{$sexo}}</td>
                                                        <td>{{$paciente->peso}}</td>
                                                        <td>{{$paciente->estatura}}</td>
                                                        <td><a href="{{ route('destroyPaciente', $paciente->id) }}">
                                                            <i class="far fa-trash-alt fa-fw mr-2 text-danger" style="font-size: 21px;"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {!! $pacientes->links('vendor.pagination.bootstrap-5'); !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('public/js/jquery-3.6.1.min.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/bootstrap-5/js/bootstrap.bundle.min.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/fontawesome-6/js/all.min.js')  }}"></script>

    </body>
</html>

