<div class="container-fluid">
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">CREAR TEXTO</span></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Textos</a></li>
                    <li class="breadcrumb-item active">Crear Texto</li>
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
                                Datos del documento</h5>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Titulo</label>
                                    <div class="col-sm-12">
                                        <input type="text" wire:model.lazy="titulo" class="form-control" name="titulo"
                                            id="titulo" aria-label="titulo" placeholder="Titulo para texto del Documento">
                                        @error('titulo')
                                            <span class="text-danger">{{ $message }}</span>
                                            <style>
                                                .nombre {
                                                    color: red;
                                                }
                                            </style>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12" wire:ignore>
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Texto</label>
                                    <div class="col-sm-12">
                                        <textarea id="texto" name="texto"></textarea>
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
                            <button class="w-100 btn btn-success mb-2" id="alertaGuardar">Actualizar texto</button>
                            <button type="button" class="w-100 btn btn-danger mb-2" wire:click='destroy'>Borrar texto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
    <script>
        $("#alertaGuardar").on("click", () => {
            const editorData = CKEDITOR.instances.texto.getData();
            @this.set('texto', editorData);

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Pulsa el botón de confirmar para guardar el Texto.',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('update');
                }
            });
        });
    </script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editor = CKEDITOR.replace('texto');
            editor.on('instanceReady', function() {
                // Carga el contenido inicial cuando el editor está listo
                this.setData(@this.texto);
            });

            // Actualizar el texto de Livewire cuando el editor pierde el foco
            editor.on('blur', function() {
                @this.set('texto', this.getData());
            });
        });
    </script>
@endsection
