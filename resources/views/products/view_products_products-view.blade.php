@extends('templates-base.template-base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                '<p>Deletando </p> <div class="spinner-grow text-danger" role="status"> </div> ',
                '</b><p class="text-danger">{{session('msgDeleteSuccess')}}</p></b>',
                ''
            )

            setTimeout(function () {
                window.location.href = '/visualizacao/produtos';
            }, 2000);

        </script>

    @endif

    @if(session('msgSuccess1'))

        <script>
            Swal.fire(
                '<p>Editando </p> <div class="spinner-grow text-info" role="status"> </div> ',
                '</b><p class="text-success">{{session('msgSuccess1')}}</p></b>',
                ''
            )

            setTimeout(function () {
                window.location.href = '/visualizacao/produtos';
            }, 2000);

        </script>

    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('visualizacao/home')}}"> <i class="fa fa-home"></i> Início</a>
            <button class="navbar-toggler" type="button" data-bs-="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(Auth::user()->name =="administrador")
                        <li class="nav-item">
                            <a class="nav-link active" href="{{url('visualizacao/usuarios')}}"> <i
                                    class="fa fa-users"></i> Usúarios </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('visualizacao/produtos')}}"><i
                                class="fa fa-list"></i> Produtos </a>
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
        <a href="{{url('novo/produto')}}" class="btn btn-info">
            <i class="fas fa-plus-square" style="color:aliceblue"></i> Adicionar produto
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
                                Descrição
                            </th>

                            <th>
                                Estoque
                            </th>

                            <th>
                                Açoes
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    {{$product->name}}
                                </td>

                                <td>
                                    {{$product->descricao}}
                                </td>

                                <td>
                                    {{$product->estoque}}
                                </td>

                                <td>
                                    <a href='{{url("visualizacao/produto/$product->id")}}'><i
                                            class="fas fa-eye mr-1"></i></a>
                                    <a href='{{url("editar/produto/$product->id")}}' id="editar-produto"> <i
                                            class="fas fa-edit mr-1  text-info"></i></a>
                                    <a href='{{url("deletar/produto/$product->id")}}' class="" id="a-delete"><i
                                            class="fas fa-trash mr-1 text-danger"></i></a>

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
        <p class="p-copy">Copyright©2021,
            <b>Crud Larável 8</b> todos os direitos reservados. Todos os textos, imagens, gráficos, animações,
            vídeos,
            músicas, sons e outros materiais são protegidos por direitos autorais e outros direitos de
            propriedade
            intelectual pertencentes à Crud Larável 8 Company, suas subsidiárias, afiliadas e licenciantes.
        </p>
    </footer>

    @if(isset($errors) && count($errors) > 0 )

        <script>
            Swal.fire({
                title: 'Atenção, não foi possível editar',
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
                        <h5 class="modal-title" id="staticBackdropLabel">Deletar produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger"><b>Deseja realmente excluir esse registro ?</b></p>
                        <div class="modal-body">
                            <form class="form form-login" action='{{url("deletar/produto/$id_delete")}}' method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="DELETE">

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-danger">Deletar</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($product_id))
        @if(isset($id_edit))
            <!-- Modal -->
            <div class="modal fade" id="Modal-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form form-login" action='{{url("editar/produto/$id_edit")}}' method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="PUT">
                                <label id="label-create-login"> Nome: </label>
                                <input id="name_produto" type="text" name="name" placeholder="Digite o nome do produto"
                                       class="form-control"
                                       value="{{$product_id->name}}" required>

                                <br>
                                <label id="label-create-login"> Estoque: </label>
                                <input id="estoque_produto" type="text" name="estoque"
                                       placeholder="Digite a descrição do produto"
                                       class="form-control"
                                       value="{{$product_id->estoque}}" required>


                                <br>
                                <label id="label-create-login"> Descrição: </label>
                                <input id="descricao_produto" type="text" name="descricao"
                                       placeholder="Digite a descrição do produto"
                                       class="form-control"
                                       value="{{$product_id->descricao}}" required>

                                <br>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </form>
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

