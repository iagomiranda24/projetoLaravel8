@extends('templates-base.template-base')
<script src="{{asset('assets/sweetalert2-js/dist/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/sweetalert2-js/dist/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

@section('content')
    @if(session('msgDeleteSuccess'))

        <script>
            Swal.fire(
                '<p> Deletando </p> <div class="spinner-grow text-danger" role="status"> </div> ',
                '</b><p class="text-danger">{{session('msgDeleteSuccess')}}</p></b>',
                ''
            )


        </script>

    @endif

@section('content')
    @if(session('msgDeleteError'))

        <script>
            Swal.fire(
                '<p> Error ao deletar </p> <div class="spinner-grow text-danger" role="status"> </div> ',
                '</b><p class="text-danger">{{session('msgDeleteError')}}</p></b>',
                ''
            )

        </script>

    @endif

    @if(session('msgSuccess'))

        <script>
            Swal.fire(
                '<p>Cadastrando </p> <div class="spinner-grow text-danger" role="status"> </div> ',
                '</b><p class="text-danger">{{session('msgSuccess')}}</p></b>',
                ''
            )


        </script>

    @endif

    @if(session('msgSuccess1'))

        <script>
            Swal.fire(
                '<p>Editando </p> <div class="spinner-grow text-info" role="status"> </div> ',
                '</b><p class="text-success">{{session('msgSuccess1')}}</p></b>',
                ''
            )


        </script>

    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('view/home')}}"> <i class="fa fa-home"></i> In??cio</a>
            <button class="navbar-toggler" type="button" data-bs-="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('view/users')}}"> <i class="fa fa-users"></i>
                            Us??arios </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('view/products')}}"><i
                                class="fa fa-list"></i> produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                    </li>
                </ul>
                <form class="" method="POST" action="{{url('logout')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-danger">Sair</button>
                </form>
            </div>
        </div>
    </nav>
    <br>

    <div class="container">
        <a href="{{url('view/register')}}" class="btn btn-info"><i class="fas fa-plus-square"
                                                                   style="color:aliceblue"></i> Adicionar
            us??ario
        </a>
    </div>
    <br>
    <div class="container">

        <div class="card shadow">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellpadding="14px"
                           cellspacing="200px">
                        <thead>
                        <tr>
                            <th>
                                Nome
                            </th>
                            <th>
                                Email
                            </th>

                            <th>
                                A??oes
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    {{$user->name}}
                                </td>

                                <td>
                                    {{$user->email}}
                                </td>


                                <td>
                                    <a href='{{url("view/user/$user->id")}}'><i class="fas fa-eye mr-1"></i></a>
                                    @if(Auth::user()->name =="administrador")
                                        <a href='{{url("edit/user/$user->id")}}' id="editar-produto"> <i
                                                class="fas fa-edit mr-1  text-info"></i></i></a>
                                    @endif
                                    @if(Auth::user()->name =="administrador")
                                        <a href='{{url("delete/user/$user->id")}}' class="" id="a-delete"><i
                                                class="fas fa-trash mr-1 text-danger"></i></i></i></a>
                                    @endif
                                </td>

                            </tr>
                        </tbody>
                        @empty

                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>



    <br>
    <br>
    <br>
    <br>
    <br>
    <footer class="footer">
        <p class="p-copy">Copyright??2021,
            <b>Crud Lar??vel 8</b> todos os direitos reservados. Todos os textos, imagens, gr??ficos, anima????es,
            v??deos,
            m??sicas, sons e outros materiais s??o protegidos por direitos autorais e outros direitos de
            propriedade
            intelectual pertencentes ?? Crud Lar??vel 8 Company, suas subsidi??rias, afiliadas e licenciantes.
        </p>
    </footer>

    @if(isset($errors) && count($errors) > 0 )

        <script>
            Swal.fire({
                title: 'Aten????o, n??o foi poss??vel editar',
                text: '@foreach($errors->all() as $error) {{$error}} @endforeach',
                icon: 'info',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        </script>

    @endif

    @if(isset($id_delete))
        <!-- Modal -->
        <div class="modal fade" id="ModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Deletar Usu??rio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger"><b>Deseja realmente excluir esse registro ?</b></p>
                        <div class="modal-body">
                            <form class="form form-login" action='{{url("delete/user/$id_delete")}}' method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($user_id))
        @if(isset($id_edit))
            <!-- Modal -->
            <div class="modal fade" id="Modal-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usu??rio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form form-login" action='{{url("edit/user/$id_edit")}}' method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="PUT">
                                <label id="label-create-login"> Nome: </label>
                                <input id="name_produto" type="text" name="name" placeholder="Digite o nome do produto"
                                       class="form-control"
                                       value="{{$user_id->name}}" required>

                                <br>
                                <label id="label-create-login"> Email: </label>
                                <input id="estoque_produto" type="text" name="email"
                                       placeholder="Digite a descri????o do produto"
                                       class="form-control"
                                       value="{{$user_id->email}}" required>

                                <br>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @if(!empty($id_delete))
                    <script>
                        $(document).ready(function () {
                            $("#ModalDelete").modal("show");
                        });
                    </script>

                @endif

                @if(!empty($id_edit))
                    <script>
                        $(document).ready(function () {
                            $("#Modal-edit").modal("show");
                        });
                    </script>

                @endif

                <script>
                    $(document).ready(function () {
                        $("#table").DataTable();
                    });
                </script>

@endsection
