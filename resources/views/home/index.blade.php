@extends("layouts.app")

@section("content")
<div class="container">
    <h1 class="text-center h4 text-white">Responda selecionando a resposta certa</h1>
    <div class="my-3">
        <div class="bg-white py-3 px-4 mx-auto rounded" style="max-width: 600px;">
            @if (Auth::check())
            <div class="text-center">
                <p class="h5 px-5 my-3">Ao clicar abaixo, o jogo já começa!</p>
                <a href="{{route('quiz')}}" class="btn btn-md btn-danger">Começar a jogar</a>
            </div>
            @else
            <div class="text-center">
                <p class="h5 px-5 my-3">Comece agora mesmo e entre nessa disputa com os seus amigos</p>
                <a href="{{route('login')}}" class="btn btn-md btn-danger">Começar</a>
            </div>
            @endif
            <div class="pt-3" id="ranking">
                <hr>
                <div>
                    <h3 class="text-center h5 pb-2">Melhores Jogadores</h3>
                </div>
                <div>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nome</th>
                                <th>Nível</th>
                                <th>Pontos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rankings as $ranking)
                            <tr>
                                <td>{{ $ranking->user->name }}</td>
                                <td>{{ $ranking->user->level->actual_level }}</td>
                                <td>{{ $ranking->total }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
