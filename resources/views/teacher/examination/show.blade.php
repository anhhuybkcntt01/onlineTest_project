@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <form action="{{route('teacher.examination.edit',['room_id'=>$room->id,'id'=>$examination->id])}}">
                            @csrf
                            <button class='btn btn-warning'>Edit this Examination </button>
                        </form>
                        <form action="{{route('teacher.examination.index',['room_id'=>$room->id,'id'=>$examination->id])}}">
                            @csrf
                            <button class='btn btn-dark'>Back to your Room </button>
                        </form>
                        <div class="card-header">Examination: {{ $examination->title }} </div>
                        @foreach($questions as $index=>$question)
                            @php
                            $inde = $index +1;
                            @endphp
                            <table width="100%">
                                <tr>
                                    <td> Câu {{$inde}}: Point = {{$question->point}}</td>
                                    <td>
                                       {!! $question->content !!}
                                    </td>
                                </tr>
                                @php
                                    $answers = $question->createdAnswers;
                                @endphp
                                @foreach($answers as $answer)

                                <tr>
                                    <td> </td>
                                    <td>
                                        @if($answer->id == $question->correct_answer_id)
                                            <form>
                                                <input
                                                    type="radio"
                                                    name="correct" checked > <label>{{$answer->content}}
                                                </label><br>
                                            </form>
                                        @else
                                            <input
                                                type="radio"
                                                name="correct" > <label>{{$answer->content}}
                                            </label><br>
                                        @endif
                                    </td>
                                </tr>


                                @endforeach
                            </table>


                        @endforeach



                </div>
            </div>
        </div>
        @endsection

        @section('js')
{{--            <script>--}}
{{--                $(document).ready(function () {--}}
{{--                    $('#summernote').summernote({--}}
{{--                        placeholder: 'Enter content....',--}}
{{--                        tabsize: 2,--}}
{{--                        height: 100,--}}
{{--                        minHeight: 50,--}}
{{--                        maxHeight: 1000,--}}
{{--                        focus: true,--}}
{{--                        toolbar: [--}}
{{--                            ['style', ['bold', 'italic', 'underline', 'clear']],--}}
{{--                            ['font', ['strikethrough', 'superscript', 'subscript']],--}}
{{--                            ['fontsize', ['fontsize']],--}}
{{--                            ['color', ['color']],--}}
{{--                            ['para', ['ul', 'ol', 'paragraph']],--}}
{{--                            ['height', ['height']],--}}
{{--                            ['table', ['table']],--}}
{{--                            ['insert', ['link', 'picture', 'video']],--}}
{{--                            ['view', ['fullscreen', 'codeview', 'help']],--}}
{{--                        ],--}}
{{--                        popover: {--}}
{{--                            image: [--}}
{{--                                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],--}}
{{--                                ['float', ['floatLeft', 'floatRight', 'floatNone']],--}}
{{--                                ['remove', ['removeMedia']]--}}
{{--                            ],--}}
{{--                            link: [--}}
{{--                                ['link', ['linkDialogShow', 'unlink']]--}}
{{--                            ],--}}
{{--                            table: [--}}
{{--                                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],--}}
{{--                                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],--}}
{{--                            ],--}}
{{--                            air: [--}}
{{--                                ['color', ['color']],--}}
{{--                                ['font', ['bold', 'underline', 'clear']],--}}
{{--                                ['para', ['ul', 'paragraph']],--}}
{{--                                ['table', ['table']],--}}
{{--                                ['insert', ['link', 'picture']]--}}
{{--                            ]--}}
{{--                        },--}}
{{--                        codemirror: {--}}
{{--                            theme: 'monokai'--}}
{{--                        }--}}
{{--                    });--}}

{{--                });--}}
{{--                // get--}}
{{--                var markupStr = $('#summernote').summernote('code');--}}

{{--                // set--}}

{{--                // $('#summernote').summernote('code', markupStr);--}}

{{--                // //check isEmpty and check validate by JS--}}
{{--                $('#create_question').on('click', function (event) {--}}
{{--                    if ($('#summernote').summernote('isEmpty')) {--}}
{{--                        alert('Question content is empty. Please to enter the content');--}}
{{--                        event.preventDefault()--}}
{{--                    }--}}
{{--                    if (!$("input[name='correct']").is(':checked')) {--}}
{{--                        alert('Choose question\'s correct answer');--}}
{{--                        event.preventDefault()--}}
{{--                    }--}}
{{--                    let point = $('#point').val();--}}
{{--                    if(point == ''){--}}
{{--                        alert('Enter question\'s point ');--}}
{{--                        event.preventDefault()--}}
{{--                    }--}}

{{--                });--}}

{{--                $('#show_all_question').on('click', function (event) {--}}
{{--                    if ($('#summernote').summernote('isEmpty')) {--}}
{{--                        alert('Question content is empty. Please to enter the content');--}}
{{--                        event.preventDefault()--}}
{{--                    }--}}
{{--                    if (!$("input[name='correct']").is(':checked')) {--}}
{{--                        alert('Choose question\'s correct answer');--}}
{{--                        event.preventDefault()--}}
{{--                    }--}}
{{--                    let point = $('#point').val();--}}
{{--                    if(point == ''){--}}
{{--                        alert('Enter question\'s point ');--}}
{{--                        event.preventDefault()--}}
{{--                    }--}}
{{--                    $('#check').val(2);--}}
{{--                });--}}

{{--            </script>--}}
@endsection
