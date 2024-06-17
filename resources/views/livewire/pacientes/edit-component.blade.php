<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">EDITAR PACIENTE</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pacientes</a></li>
                    <li class="breadcrumb-item active">Editar paciente</li>
                </ol>
            </div>
        </div> <!-- end row -->
    </div>
    <!-- end page-title -->

    <div class="row">
        <div class="col-md-9">
            <div class="card m-b-30">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <h5 class="ms-3" style="border-bottom: 1px gray solid !important; padding-bottom: 10px !important;">
                                Datos del Paciente</h5>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Nombre</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="nombre" class="form-control" name="nombre"
                                            id="nombre" aria-label="Nombre" placeholder="Nombre">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                            <style>
                                                .nombre {
                                                    color: red;
                                                }
                                            </style>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Apellidos</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="apellido" class="form-control" name="apellido"
                                        id="apellido" placeholder="Apellidos">
                                        @error('apellido')
                                        <span class="text-danger">{{ $message }}</span>

                                        <style>
                                            .apellido {
                                                color: red;
                                            }
                                            </style>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Dni</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="dni" class="form-control" name="dni"
                                        id="dni" placeholder="DNI">
                                        @error('apellido')
                                        <span class="text-danger">{{ $message }}</span>

                                        <style>
                                            .apellido {
                                                color: red;
                                            }
                                            </style>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Tipo de Calle -->
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="email" class="col-sm-12 col-form-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="email" class="form-control"
                                            name="email" id="email" placeholder="Email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>

                                            <style>
                                                .tipoCalle {
                                                    color: red;
                                                }
                                            </style>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="telefono" class="col-sm-12 col-form-label">Télefono</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="telefono" class="form-control" name="telefono"
                                            id="telefono" placeholder="Télefono">
                                        @error('telefono')
                                            <span class="text-danger">{{ $message }}</span>

                                            <style>
                                                .calle {
                                                    color: red;
                                                }
                                            </style>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Direccion</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="direccion" class="form-control"
                                            name="direccion" id="direccion" placeholder="Direccion">
                                        @error('direccion')
                                            <span class="text-danger">{{ $message }}</span>

                                            <style>
                                                .ciudad {
                                                    color: red;
                                                }
                                            </style>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card m-b-30">
                <div class="card-body"wire:ignore>
                    <h4 class="mt-0 header-title">Listado de todos los Documentos</h4>
                    @if (count($documentos) > 0)
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $documento)
                                    <tr>
                                        <td>{{ $documento->titulo }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary mb-2" wire:click='descargar({{$documento->id}})'>Descargar</button>
                                            <button type="button" class="btn btn-danger mb-2 destroy-document" data-id="{{ $documento->id }}" >Borrar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <h5>Guardado</h5>
                    <div class="row">
                        <div class="col-12">
                            <button class="w-100 btn btn-success mb-2" id="alertaGuardar">Actualizar Paciente</button>
                            <button type="button" class="w-100 btn btn-danger mb-2" wire:click='destroy'>Borrar Paciente</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <h5>Acciones</h5>
                    <div class="row">
                        <div class="col-12">
                            <button class="w-100 btn btn-info mb-2" id="btnNuevoDocumento">Generar nuevo documento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="nuevoDocumentoModal" class="modal" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Centrado verticalmente -->
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Nuevo Documento</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="texto_id" class="form-label">Documento</label>
                        <div class="col-sm-12" wire:ignore>
                            <select data-pharaonic="select2"
                                    data-component-id="{{ $this->id }}"
                                    class="form-control"
                                    wire:model="texto_id"
                                    data-placeholder="Documento"
                                    data-clear>
                                <option value="">Seleccione</option>
                                @foreach ($textos as $texto)
                                    <option value={{$texto->id}}>{{$texto->titulo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="texto_id" class="form-label">Texto</label>
                        <div class="card">
                            <div class="card-body">
                                <p style="white-space: pre-line;">{{ $textoSeleccionado }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center"> <!-- Centra el formulario -->
                        <div class="w-100" style="max-width: 500px;"> <!-- Ajusta el ancho máximo -->
                            <label for="signature-pad" class="form-label">Firma</label>
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <canvas id="signature-pad" class="signature-pad border" width="400" height="200"></canvas>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button id="save-button" class="btn btn-primary">Firmar</button>
                                    <button id="clear-button" class="btn btn-secondary">Limpiar Firma</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<style>
    .modal-dialog {
        max-width: 70%; /* Ancho adaptable del modal */
        width: 100%;
        }
    .modal{
            background-color: rgba(0, 0, 0, 0.4);
    }
    .modal-content {
        height: 90vh; /* Altura fija del modal */
        overflow: hidden;
    }

    @media (max-width: 768px){
        .modal-dialog {
        max-width: 97%; /* Ancho adaptable del modal */
        width: 100%;
        }
    }
    .modal-body {
        overflow-y: auto; /* Permitir scroll dentro del cuerpo del modal */
        background-color: #F9F9F9;
    }

    .card-footer {
        padding: 10px; /* Ajusta el padding del footer */
    }

    #signature-pad {
        display: block;
        margin: auto; /* Centra el canvas dentro de la tarjeta */
    }
</style>

<script src="../../assets/js/jquery.slimscroll.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="../../assets/js/jquery.slimscroll.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/datatables/jszip.min.js"></script>
<script src="../../plugins/datatables/pdfmake.min.js"></script>
<script src="../../plugins/datatables/vfs_fonts.js"></script>
<script src="../../plugins/datatables/buttons.html5.min.js"></script>
<script src="../../plugins/datatables/buttons.print.min.js"></script>
<script src="../../plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="../../plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="../../assets/pages/datatables.init.js"></script>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        var canvas = document.getElementById('signature-pad');

        // Asegúrate de que el canvas se ajuste correctamente al tamaño del contenedor
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;

        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });

                function preventDefault(e) {
                e.preventDefault();
            }

            canvas.addEventListener('touchstart', function(e) {
                e.preventDefault();
                document.body.addEventListener('touchmove', preventDefault, { passive: false });
            });

            canvas.addEventListener('touchend', function() {
                document.body.removeEventListener('touchmove', preventDefault, { passive: false });
            });

        // Opcional: Agrega botones y funcionalidades para guardar o limpiar la firma
        document.getElementById('clear-button').addEventListener('click', function () {
            signaturePad.clear();
        });

        document.getElementById('save-button').addEventListener('click', function () {
            var data = signaturePad.toDataURL('image/png');
            @this.saveSignature(data); // Enviar la firma a Livewire
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        var modal = document.getElementById("nuevoDocumentoModal");
        var btn = document.getElementById("btnNuevoDocumento");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
            modal.style.display = "flex";
            $('.form-control[data-pharaonic="select2"]').select2({
            placeholder: "Seleccione", // Asegúrate de que los atributos correspondan
            allowClear: Boolean($(this).data('clear')) // maneja la posibilidad de limpiar el valor
        });
        }

        span.onclick = function () {
            modal.style.display = "none";
        }
    });



        $("#alertaGuardar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Pulsa el botón de confirmar para guardar el cliente.',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('update');
                }
            });
        });

    document.addEventListener("DOMContentLoaded", function () {
        var buttons = document.querySelectorAll('.destroy-document');

        buttons.forEach(function(button) {
            button.addEventListener('click', function () {
                var documentId = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Seguro que desea borrar el documento? No hay vuelta atrás',
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonText: 'Sí',
                    showCancelButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('confirmDeleteDoc', documentId);
                    }
                });
            });
        });
    });

    window.addEventListener('refresh-page', event => {
        window.location.reload();
    });
    </script>
@endsection
