@extends('templates-base.template-base')
<script src="{{asset('assets/sweetalert2-js/dist/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/sweetalert2-js/dist/sweetalert2.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css ">
<script src="https://cdn.jsdelivr.net /npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
@section('content')

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
                window.location.href = '/view/home';
            }, 2000);

        </script>

    @endif

    @if(session('msgError'))

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
                icon: 'error',
                title: '</b><p class="text-success">{{session('msgError')}}</p></b>'
            })

            setTimeout(function () {
                window.location.href = '/view/login';
            }, 2000);

        </script>

    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('view/home')}}"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg> Início</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
            </div>
        </div>
    </nav>

    <div class="form-login-cadastro row">

        <div class="login col-6">
            <div class="h1-login">
                <h1 class="text-center" id="title-form"> Login  </h1>
            </div>
            <form class="form form-login" action="{{url('autenticate/login')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <br>
                <label id="label-create-login"> Email: </label>
                <input id="inputs" type="email" name="email" placeholder="Digite seu email" class="form-control"
                       value="{{old('email')}}" required>
                <br>
                <label id="label-create-login"> Senha: </label>
                <input id="inputs" type="password" name="password" placeholder="Digite sua senha" class="form-control"
                       value="" required>

                <br>
                <div class="button-login row">
                    <button type="submit" id="button-login" value="Salvar" class="btn btn-success"> Entrar</button>
                </div>
            </form>

            <br><br>
            <div class="text-danger p-copy">
                <a class="p-copy" href="{{url('view/register')}}"> Cadastre-se </a>
            </div>
            <style>
                .p-copy {
                  text-decoration: none;
                }
            </style>
        </div>
        <div>
            <footer class="footer">
                <p class="p-copy">Copyright©2021,
                    <b>Crud Larável 8</b> todos os direitos reservados. Todos os textos, imagens, gráficos, animações,
                    vídeos,
                    músicas, sons e outros materiais são protegidos por direitos autorais e outros direitos de
                    propriedade
                    intelectual pertencentes à Crud Larável 8 Company, suas subsidiárias, afiliadas e licenciantes.
                </p>
            </footer>
        </div>
@endsection
