@extends('templates-base.template-base')
<script src="{{asset('assets/sweetalert2-js/dist/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/sweetalert2-js/dist/sweetalert2.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css ">
<script src="https://cdn.jsdelivr.net /npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('home')}}"> <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg> Início</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('produtos')}}"><i class=""></i> <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-view-list" viewBox="0 0 16 16">
                                <path d="M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1H3zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2zm0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14z"/>
                            </svg>   Produtos</a>
                    </li>
                    @if(Auth::user()->name =="administrador")
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('users')}}"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>  Usúarios </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                    </li>
                        @endif
                </ul>
                <form class="" method="POST" action="{{url('logout')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-danger">Sair</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="form-login-cadastro row">

        @if(session('msgSuccess'))

            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-right',
                    showConfirmButton: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: '</b><p class="text-success">{{session('msgSuccess')}}</p></b>'
                })

                setTimeout(function () {
                    window.location.href = '/produtos';
                }, 2000);

            </script>

        @endif

            @if(session('msgSuccess1'))

                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-right',
                        showConfirmButton: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: '</b><p class="text-success">{{session('msgSuccess1')}}</p></b>'
                    })

                    setTimeout(function () {
                        window.location.href = '/produtos';
                    }, 2000);

                </script>

            @endif



        <div class="login col-6">
            <div class="h1-login">
                <h1 class="text-center" id="title-form"> Cadastrar produto </h1>
            </div>
            <form class="form form-login" action="{{url('cadastrar-produto')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <label id="label-create-login"> Nome: </label>
                <input id="inputs" type="text" name="name" placeholder="Digite o nome do produto" class="form-control"
                       value="{{old('name')}}" required>
                @if(isset($errors) && count($errors) > 0 )


                    @foreach($errors->get('name') as $error)

                    <b> <span class="text-danger"> {{$error}} </span></b> @endforeach

                @endif
                <br>
                <label id="label-create-login"> Estoque: </label>
                <input id="inputs" type="text" name="estoque" placeholder="Digite a descrição do produto"
                       class="form-control"
                       value="{{old('estoque')}}" required>

                @if(isset($errors) && count($errors) > 0 )
                    @foreach($errors->get('estoque') as $error)
                        <b><span class="text-danger"> {{$error}}</span></b>
                    @endforeach
                @endif
                <br>
                <label id="label-create-login"> Descrição: </label>
                <input id="inputs" type="text" name="descricao" placeholder="Digite a descrição do produto"
                       class="form-control"
                       value="{{old('')}}" required>

                @if(isset($errors) && count($errors) > 0 )
                    @foreach($errors->get('descricao') as $error)
                        <b><span class="text-danger"> {{$error}} </span></b>
                    @endforeach
                @endif

                <br>
                <div class="button-login row">
                    <button type="submit" id="button-login" class="btn btn-success"> Salvar</button>
                </div>
            </form>
        </div>

        <div>
            <footer class="footer">
                <p class="p-copy">Copyright©2021,
                    <b>Crud Larável 8</b> todos os direitos reservados. Todos os textos, imagens, gráficos,
                    animações,
                    vídeos,
                    músicas, sons e outros materiais são protegidos por direitos autorais e outros direitos de
                    propriedade
                    intelectual pertencentes à Crud Larável 8 Company, suas subsidiárias, afiliadas e
                    licenciantes.
                </p>
            </footer>
        </div>
@endsection

