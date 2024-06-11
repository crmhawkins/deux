<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">CREAR PACIENTE</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pacientes</a></li>
                    <li class="breadcrumb-item active">Crear paciente</li>
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
        </div>
        <div class="col-md-3 ">
            <div class="card m-b-30 ">
                <div class="card-body">
                    <h5>Acciones</h5>
                    <div class="row">
                        <div class="col-12">
                            <button class="w-100 btn btn-success mb-2" id="alertaGuardar">Guardar
                                Cliente</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $("#alertaGuardar").on("click", () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Pulsa el botón de confirmar para guardar el cliente.',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('submit');
                }
            });
        });

    </script>
@endsection
