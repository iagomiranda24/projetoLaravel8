@extends('templates-base.template-base')
<script src="{{asset('assets/sweetalert2-js/dist/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/sweetalert2-js/dist/sweetalert2.css')}}">
@section('content')
    <link rel="stylesheet" href="{{asset('assets/DataTables-1.10.23/css/jquery.dataTables.css')}}">
    <script src="{{asset('assets/DataTables-1.10.23/js/jquery.dataTables.js')}}"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('home')}}"> <i class="fa fa-home"></i> Início</a>
            <button class="navbar-toggler" type="button" data-bs-="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(Auth::user()->name == "administrador")
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('users')}}"> <i class="fa fa-users"></i> Usúarios </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('users')}}"> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{url('/produtos')}}"><i
                                class="fa fa-list"></i> Listar produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    {{--                <li class="nav-item dropdown">--}}
                    {{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
                    {{--                    </a>--}}
                    {{--                    <ul class="" aria-labelledby="navbarDropdown">--}}
                    {{--                        <li><a class="dropdown-item" href="#">Action</a></li>--}}
                    {{--                        <li><a class="dropdown-item" href="#">Another action</a></li>--}}
                    {{--                        <li><hr class="dropdown-divider"></li>--}}
                    {{--                        <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                    {{--                    </ul>--}}
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

    <div class="container" id="div-table-id">

        <div class="card shadow alert">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_id" width="100%" cellpadding="14px"
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
                                Password
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$user->name}}
                                </td>

                                <td>
                                    {{$user->email}}
                                </td>

                                <td>
                                    {{$user->password}}
                                </td>

                            </tr>
                        </tbody>
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



@endsection
