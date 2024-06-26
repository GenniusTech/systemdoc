<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Grupo Sollution - Gestão de Processos</title>

        <link rel="icon" type="image/png" href="{{ asset('admin/assets/icon.png') }}" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


        <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/relogio/style.css') }}" type="text/css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/js/pesquisa.js') }}"></script>
    </head>

    <body id="page-top">
        <div id="wrapper">

            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Grupo Sollution</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('dashboard') }}"> <i class="fas fa-fw fa-chart-area"></i> <span>Dashboard</span></a>
                </li>

                <hr class="sidebar-divider">

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePositive"
                        aria-expanded="true" aria-controls="collapsePositive">
                        <i class="fa fa-check"></i>
                        <span>Limpa Nome</span>
                    </a>
                    <div id="collapsePositive" class="collapse" aria-labelledby="headingPositive"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('vendaDireta', ['id' => 1 ]) }}">Cadastrar CPF/CNPJ</a>
                            <a class="collapse-item" href="{{ route('lista') }}">Listas</a>
                            <a class="collapse-item" href="{{ route('marketing', ['id' => 1 ]) }}">Documentos de Apoio</a>
                        </div>
                    </div>
                </li>

                @if(Auth::user()->tipo == 1)
                <!--<li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinanceiro"
                        aria-expanded="true" aria-controls="collapseFinanceiro">
                        <i class="fa fa-credit-card"></i>
                        <span>Gestão Financeira</span>
                    </a>
                    <div id="collapseFinanceiro" class="collapse" aria-labelledby="headingFinanceiro"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="#">Relação de Pagamentos</a>
                            <a class="collapse-item" href="#">Relação de Débitos</a>
                        </div>
                    </div>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParceria" aria-expanded="true" aria-controls="collapseParceria">
                        <i class="fa fa-briefcase"></i>
                        <span>Gestão Administrativa</span>
                    </a>
                    <div id="collapseParceria" class="collapse" aria-labelledby="headingParceria" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('lista') }}">Lista</a>
                            <a class="collapse-item" href="{{ route('usuario') }}">Parceiros</a>
                            <a class="collapse-item" href="{{ route('materiais') }}">Documentos de Apoio</a>
                            <a class="collapse-item" href="{{ route('message') }}">Mensagem</a>
                        </div>
                    </div>
                </li>
                @endif

                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <p>Olá, {{ Auth::user()->nome }}. Bem-vindo(a)!</p>
                            <div class="marquee-container">
                                @foreach($messages as $message)
                                    <span class="marquee-item">{{ $message->descricao }}</span>
                                @endforeach
                            </div>
                        </div>

                        <ul class="navbar-nav ml-auto">
                            {{-- <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell fa-fw"></i>
                                        <span class="badge badge-danger badge-counter"> 3+ </span>
                                    </a>

                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                        <h6 class="dropdown-header bg-success"> Notificações </h6>

                                        @foreach ($notfic as $notfi)
                                            <form action="{{ route('notificacao.destroy', $notfi->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item d-flex align-items-center" href="#" onclick="this.closest('form').submit()">
                                                    <div class="mr-3">
                                                        <div class="icon-circle bg-primary"> <i class="fas fa-file-alt text-white"></i> </div>
                                                    </div>
                                                    <div>
                                                        <div class="small text-gray-500">{{ $notfi->data}}</div>
                                                        <span class="font-weight-bold">{{ $notfi->mensagem}}</span>
                                                    </div>
                                                </a>
                                            </form>
                                        @endforeach

                                        <a class="dropdown-item text-center small text-gray-500" href="#">Não há mais nada.</a>
                                    </div>
                                </li> --}}

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="img-profile rounded-circle" src="{{ asset('admin/assets/perfil_padrao.svg') }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('perfil') }}"> <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Sair </a>
                                </div>
                            </li>
                        </ul>

                    </nav>

                    @yield('conteudo')

                </div>

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto"> <span>Copyright &copy; <a href="https://techgennius.com.br/">Tech Gennius</a> </span> </div>
                    </div>
                </footer>

            </div>

        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: `{{session('success')}}`,
                })
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: `{{session('error')}}`,
                })
            </script>
        @endif

        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('admin/js/pesquisa.js') }}"></script>
    </body>
</html>
