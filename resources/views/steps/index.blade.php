<div id="all">
    <div id="questions">
        @if ($questions)
        <div class="text-center w-100">

            <span class="fw-bold">{{ $questions->level->step }}/{{ $questions->level->where('level',
                $user_level->actual_level)->count()
                }}</span>
        </div>
        <div class="row">
            <div class="col-6 fw-bold">Nível {{ $user_level->actual_level }}</div>
            <div class="col-6 text-end fw-bold" id="count-down-timer"></div>
        </div>
        <hr>
        <div id="stepsId">
            <div class="my-3">
                <h2 class="h4">{{ $questions->question }}</h2>
            </div>
            <input type="hidden" name="question_id" id="question_id" value="{{ $questions->id }}">
            @foreach ($questions->answers as $answer)
            <div class="my-3">
                <input type="button" name="answer[]" class="border w-100 py-2 text-start form-control
                text-capitalize answer" value="{{ $answer->answer }}">
            </div>
            @endforeach
            <div class="text-center" id="no-answer"></div>
            <div class="text-end">
                <a class="btn btn-success d-none" id="continue" onclick="continue_questions();">
                    Continuar
                </a>
            </div>
        </div>
        @else
        <h3 class="text-center">Parabéns você chegou ao final!</h3>
        <p class="text-center">Aguarde algum tempo e retorne para responder a mais
            perguntas.</p>
        @endif
    </div>
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
