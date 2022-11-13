<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reto Web Full-Stack</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1.13.2/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-6/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/retoweb.css') }}">
</head>
<body class="bg-dark">


    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8">
                <div class="card rgba-grey-slight z-depth-2">
                    <div class="card-body p-2">
                        {!! Form::open(['route' => array('updatePaciente', $id), 'method' => 'PUT']) !!}
                        @csrf
                        <div class="card z-depth-2">
                            <div class="col-12 px-3 py-1">
                                <div class="row align-items-center card-header text-white bg-warning py-2">
                                    <div class="col-md-12 col-lg-6 h3 m-0 p-0 ta-cl">
                                        <i class="fa fa-user-plus text-light ml-2"></i>
                                         Editar Paciente
                                    </div>
                                </div>
                            </div>

                            <div class="card-body mt-5">
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="mb-2">
                                            <i class="fa fa-user text-info mr-1"></i>
                                            <label class="text-muted mb-2" for="nombre">Nombre del paciente</label>
                                            <input maxlength="64" type="text" name="nombre" placeholder="Nombre" id="nombre" oninput="this.value=this.value.slice(0,64)" class="form-control nombre required" value="{{$paciente->nombre}}" data-placement="top">
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="mb-2">
                                            @php
                                                $fecha = $paciente->nfecha->format('m/d/Y');
                                            @endphp
                                            <i class="fas fa-calendar-plus text-info mr-1"></i>
                                            <label class="text-muted mb-2" for="fecha">Fecha de Nacimiento</label>
                                            <input type="text" id="datepicker" name="nfecha" placeholder="dd/mm/aaaa" class="form-control required"  value="{{$fecha}}">
                                        </div>
                                    </div>

                                    <div class="col-4 mb-4">
                                        <div class="mb-2" >
                                            <i class="fas fa-calendar-plus text-info mr-1"></i>
                                            <label class="text-muted mb-2">Edad</label>
                                            <input type="text" id="edad" name="edad" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-4">
                                        <div class="mb-2">
                                            <i class="fa-solid fa-genderless text-info mr-1"></i>
                                            <label class="text-muted mb-2" for="sexo">Sexo</label>
                                            <select class="form-select" name="sexo" id="sexo">
                                                <option value="M" {{$paciente->sexo == 'M'?'Selected':''}}>Masculino</option>
                                                <option value="F" {{$paciente->sexo == 'F'?'Selected':''}}>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="mb-2">
                                            <i class="fa-solid fa-weight-scale text-info mr-1"></i>
                                            <label class="text-muted mb-2" for="peso">Peso (Kg)</label>
                                            <input maxlength="3" type="number" name="peso" placeholder="Peso" id="peso" oninput="this.value=this.value.slice(0,3)" class="form-control required peso" value="{{$paciente->peso}}">
                                        </div>
                                    </div>
                                    <div class="col-4 mb-4">
                                        <div class="mb-2">
                                            <i class="fa-solid fa-ruler-vertical text-info mr-1"></i>
                                            <label class="text-muted mb-2" for="estatura">Estatura (cm)</label>
                                            <input type="number" name="estatura" placeholder="Estatura" id="estatura" class="form-control required estatura text-muted" value="{{$paciente->estatura}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="liveAlertPlaceholder"></div>
                            <hr>
                            <div class="col-12 modal-footer justify-content-center mb-3">
                                <button id="onclick" class="btn btn-warning">Guardar <i class="fa fa-paper-plane"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/jquery-3.6.1.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/jquery-ui-1.13.2/jquery-ui.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-5/js/bootstrap.bundle.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/fontawesome-6/js/all.min.js')  }}"></script>
    <script>

        $(function(){
            $("#datepicker").datepicker({
                changeMonth:true,
                changeYear:true,
            });
            $('#datepicker').on('change', calcularEdad);

            let inp = document.querySelector('.nombre');
            let clickEvent = new Event('focus');
            inp.dispatchEvent(clickEvent);

        });

        $('form').on('keyup change paste focus', 'input, select, textarea', function(){
            var alertPlaceholder = document.getElementById('liveAlertPlaceholder')
            if(jQuery.inArray($("#sexo").val(), ["M","F"]) != -1 && $("#peso").val() != "" && $("#estatura").val() != "" && $("#nombre").val() != "" && $("#datepicker").datepicker("getDate") != null)
            {
                var genero
                function alerta(message, type) {
                    alertPlaceholder.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible mx-3" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                }

                function fibonachi(estatura) {
                    var first_number = 0;
				    var second_number = 1;

                    while (estatura > second_number) {
                        var next_number = first_number + second_number;
                        first_number = second_number;
                        second_number = next_number;
                    }
                    if (second_number-estatura <= estatura-first_number) return second_number
                    else return first_number
                }


                if ($("#edad").val() < 18 ) {
                    if ($("#sexo").val() == "M")
                        genero = "un"
                    else { genero = "una" }
                    alerta('Hola ' + $("#nombre").val() + ' eres ' + genero + ' joven muy saludable, te recomiendo salir a jugar al aire libre durante ' + fibonachi($("#estatura").val()) + ' horas diarias!', 'warning')
                }
                else {
                    if ($("#peso").val() < 30 ) { recomendacion = "mas" } else { recomendacion = "menos" }
                    var km = Math.sqrt($("#datepicker").val().slice(-2)).toFixed(2)
                    alerta('Hola ' + $("#nombre").val() + ' eres una persona muy saludable, te recomiendo comer ' + recomendacion + ' y salir a correr ' + km + ' km diarios', 'info')
                }
            }
            else {
                alertPlaceholder.innerHTML = ""
            }
        });


        function calcularEdad() {

            fecha = $(this).val();
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();

            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            }
            $('#edad').val(edad);
        }

        $('#edad').val({{$edad = Carbon\Carbon::parse($paciente->nfecha )->age;}});

    </script>
</body>
</html>
