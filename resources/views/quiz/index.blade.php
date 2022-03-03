@extends("layouts.app")

@push('style')
<style>
    .bg-green {
        background-color: rgb(141, 202, 141) !important;
    }

    .bg-red {
        background-color: rgb(236, 169, 169) !important;
    }

    input:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    input.answer {
        background-color: #e9ecef;
    }
</style>
@endpush

@section("content")
<div class="container">
    <h1 class="text-center h4 text-white">Responda selecionando a resposta certa</h1>
    <div class="my-3">
        <form action="" class="bg-white py-3 px-4 mx-auto rounded" style="max-width: 600px;" method="post">
            @if (Auth::check())
            @include('steps.index')
            @else
            <div class="text-center">
                <p class="h5 px-5 my-3">Comece agora mesmo e entre nessa disputa com os seus amigos</p>
                <a href="{{route('login')}}" class="btn btn-lg btn-danger">Começar</a>
            </div>
            @endif

        </form>
    </div>
</div>
@endsection

@push('script')
<script>
    function continue_questions(){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type:'GET',
                url:"{{URL::to("/next-question")}}",
                dataType: 'html',
                success: function(result) {
                    $('#all').html(result);
                    let time_minutes = 0; // Value in minutes
                    let time_seconds = 30; // Value in seconds

                    let duration = time_minutes * 60 + time_seconds;

                    element = document.querySelector('#count-down-timer');
                    element.textContent = `${paddedFormat(time_minutes)}:${paddedFormat(time_seconds)}`;

                    startCountDown(--duration, element);
                },
                error: function(result) {
                    $('#all').html(result);
                }
            })
        };



    function paddedFormat(num) {
    return num < 10 ? "0" + num : num;
}


function startCountDown(duration, element) {

    let secondsRemaining = duration;
    let min = 0;
    let sec = 0;

    let countInterval = setInterval(function () {

        min = parseInt(secondsRemaining / 60);
        sec = parseInt(secondsRemaining % 60);

        localStorage.setItem("time_minutes", min);
        localStorage.setItem("time_seconds", sec);
        element.textContent = `${paddedFormat(min)}:${paddedFormat(sec)}`;

        secondsRemaining = secondsRemaining - 1;
        if (secondsRemaining < 0) {
            clearInterval(countInterval);
            $('#no-answer').html('Não escolheu nenhuma das alternativas');
            $('#continue').toggleClass('d-none');
            $('input[name="answer[]"]').toggleClass('bg-red is-invalid');
            $('input[name="answer[]"]').attr('disabled', 'disabled');
        }
            $('input[name="answer[]"]').on('click', function (e) {
            if (secondsRemaining > 0){
            $('input[name="answer[]"]').attr('disabled', 'disabled');
            $answer=$(this);
            $question_id=$('#question_id').val();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type:'POST',
                url:"{{URL::to("/check-answer")}}",
                dataType: 'json',
                data: {'answer':$answer.val(), 'question_id':$question_id},
                success: function(result) {
                    if ($answer.val() == result.answer) {
                        $answer.toggleClass('bg-green is-valid');


                    }else{
                        $answer.toggleClass('bg-red is-invalid');
                    };
                    $('#continue').toggleClass('d-none');
                }
            });
            secondsRemaining = 0;
            clearInterval(countInterval);
        }
        });

    }, 1000);

}

 $(document).ready(function (){

    if(typeof localStorage.getItem("time_minutes") !== 'undefined' && typeof localStorage.getItem("time_seconds") !== 'undefined' && localStorage.getItem("time_minutes")!= null && localStorage.getItem("time_seconds")!= null ){
        var time_minutes = localStorage.getItem("time_minutes");
        var time_seconds = localStorage.getItem("time_seconds");
    }
    else {
        let time_minutes = 0; // Value in minutes
        let time_seconds = 30; // Value in seconds
    }



    let duration = time_minutes * 60 + time_seconds;

    element = document.querySelector('#count-down-timer');
    element.textContent = `${paddedFormat(time_minutes)}:${paddedFormat(time_seconds)}`;

    startCountDown(--duration, element);
});

</script>
@endpush
