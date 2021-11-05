@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Economía</h1>
    @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <button class="btn btn-info btn-sm" onclick="addTypeEconomy()"><i class="fa fa-plus"></i></button>
                    <div class="btn-group btn-group-sm ml-2" role="group" aria-label="Basic example">
                        @foreach ($boxtypes as $data)
                            <a href="javascript:void(0)" onclick="btnTypes({{ $data->id }})"
                                id="btnType{{ $data->id }}" class="btn btn-outline-primary {{ $loop->first ? 'active' : '' }}">
                                {{ $data->type }}
                            </a>

                        @endforeach
                    </div>
                    {{-- <select class="custom-select" id="type_id" required>

                        @foreach ($boxtypes as $row)
                            <option value="{{ $row->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $row->type }}</option>
                        @endforeach
                    </select> --}}

                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-header">

                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <button class="btn btn-success btn-sm" onclick="addEconomy()"><i class="fa fa-plus"></i> Crear
                                economía</button>
                        </div>
                        <div class="col-md-3 mb-3">
                            <select class="custom-select" name="member_id" id="member" required>
                                <option selected disabled value="">Filtro por mes</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>

                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <select class="custom-select" name="member_id" id="member" required>
                                <option selected disabled value="">Filtro por año</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <button class="btn btn-outline-dark btn-sm">Todo</button>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table id="tblEconomy" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombres</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Ingresos</th>
                                <th>Egresos</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <!-- Modal New Box Type -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Caja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.cajas.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="caja">Nombre Caja</label>
                                <input type="text" class="form-control" name="caja" id="caja" required
                                    placeholder="Escriba una caja">
                                <div class="invalid-feedback">
                                    El campo es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Acepto los términos y condiciones
                                </label>
                                <div class="invalid-feedback">
                                    Debe aceptar antes de enviar.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Agregar caja</button>
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                    {{-- <button type="button" class="btn btn-primary">Agregar</button> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Economy -->
    <div class="modal fade" id="modalEconomy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Caja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.economia.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input type="text" name="type_id" id="typeId" value="1" hidden>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="member">Nombre</label>
                                <select class="custom-select" name="member_id" id="member" required>
                                    <option selected disabled value="">Seleccione un Miembro...</option>
                                    @foreach ($members as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Debe seleccionar un miembro.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="description">Descripción</label>
                                <input type="text" class="form-control" name="description" id="description" required
                                    placeholder="Escriba una descripcion">
                                <div class="invalid-feedback">
                                    El campo descripción es obligatorio.
                                </div>
                            </div>
                        </div>
                        <label for="Rol" class="col-sm-12 col-form-label">Tipo de registro económico</label>
                        <div class="form-group row d-flex justify-content-center">

                            <div class="form-check col-sm-3">
                                <input class="form-check-input" checked="checked" type="radio" name="role" value="1">
                                <label class="form-check-label">Ingreso</label>
                            </div>
                            <div class="form-check col-sm-3">
                                <input class="form-check-input" type="radio" name="role" value="2">
                                <label class="form-check-label">Egreso</label>
                            </div>
                        </div>
                        <div class="form-row" id="ingresoId">
                            <div class="col-md-12 mb-3">
                                <label for="income">Ingreso</label>
                                <input type="number" min="0" class="form-control" name="income" id="income" value="0"
                                    required placeholder="Escriba una ingreso">
                                <div class="invalid-feedback">
                                    El campo es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="egresoId" style="display:none;">
                            <div class="col-md-12 mb-3">
                                <label for="egress">Egreso</label>
                                <input type="number" min="0" class="form-control" name="egress" id="egress" value="0"
                                    required placeholder="Escriba una egreso">
                                <div class="invalid-feedback">
                                    El campo es obligatorio.
                                </div>
                                <div id="validateEgress" style="display:none;">
                                    <span class="text-danger">
                                        El egreso no debe exeder el total de la Caja.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Acepto los términos y condiciones
                                </label>
                                <div class="invalid-feedback">
                                    Debe aceptar antes de enviar.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" id="btnRegisterEconomy" type="submit">Registrar
                            economía</button>
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                    {{-- <button type="button" class="btn btn-primary">Agregar</button> --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css"> --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.css" /> --}}
@stop

@section('js')
    {{-- <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.js">
    </script> --}}
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}

    <script>
        function btnTypes(id) {
            var tam = {{ count($boxtypes) }};
            for (var i = 1; i <= tam; i++) {
                $("#btnType" + i).removeClass("active");
            }
            $("#btnType" + id).addClass("active");
            $('#typeId').val(id);
        }

    </script>
    <script>

        function addTypeEconomy() {
            $('#myModal').modal('show');
        }

        function addEconomy() {
            $('#modalEconomy').modal('show');
            $('input:radio[name=role]').change(function() {
                if (this.value == '1') {
                    var ingreso = document.getElementById('ingresoId');
                    ingreso.style.display = 'block';
                    var egreso = document.getElementById('egresoId');
                    egreso.style.display = 'none';
                    $('#egress').removeAttr('required');
                } else if (this.value == '2') {
                    var egreso = document.getElementById('egresoId');
                    egreso.style.display = 'block';
                    var ingreso = document.getElementById('ingresoId');
                    ingreso.style.display = 'none';
                    $('#income').removeAttr('required');
                }

            });

        }
        $('#btnRegisterEconomy').on('click', function() {
            //alert('hola');
            var total = 500;//;
                var egre = $('#egress').val();
                alert(egre);
                if(egre > total){
                    var egreso = document.getElementById('validateEgress');
                    egreso.style.display = 'block';
                }
        });
        //charge data table
        function mytable(activity_id) {
            var table = $('#tblEconomy').DataTable({
                processing: true,
                //serverSide: true,
                responsive: true,
                autoWidth: false,
                paging: true,
                ordering: true,
                searching: true,
                showing: true,
                destroy: true,
                "bInfo": true,
                "language": {
                    "lengthMenu": "Mostrar " +
                        '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select>' +
                        " registros por página",
                    "zeroRecords": "No existe registros - discupa",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    //'print',
                    {
                        extend: 'print',
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-print"></i> Imprimir',

                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after($('#statistic').html());
                            $(window.document.body)
                                .prepend('<img style="position:absolute; top:6; right:10;width:70" src=' +
                                    $logo + '>')
                            $(window.document.body).find('table')
                                //.removeClass('dataTable')
                                //.css('font-size', '12px')
                                .css('margin-top', '65px')
                            //.css('margin-bottom', '60px')
                        }
                    },

                    {
                        extend: 'colvis',
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-eye"></i> Columna Visible',

                        exportOptions: {
                            columns: ':visible'
                        },
                    },

                ],
                columnDefs: [{
                    visible: false
                }],
                /* "ajax": {
                    "url": "{{ route('admin.tblassistance') }}",
                    type: 'POST',
                    data: {
                        activity_id: activity_id,
                    },
                    cache: false,

                }, */
                /* columns: [{
                        data: 'ci',
                        name: 'ci'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'surname',
                        name: 'surname'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        className: 'text-center'
                    },
                ], */
                /*  order: [
                     [0, 'desc']
                 ], */
            });
            $logo =
                'data:image/jpeg;base64,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';


        }
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@stop
