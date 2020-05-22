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
                    <div class="card-header">Create New Question</div>


                    <div> {!!  $question->content !!}</div>


                    <div class="form-group row">
                        <label for="point"
                               class="col-md-4 col-form-label text-md-left">Point: {{$question->point}}</label>
                    </div>

                    <form method="POST"
                          action="{{route('teacher.answer.store',['room_id'=>$room->id,
                                                                    'examination_id'=>$examination->id,'question_id'=>$question->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="options[]"> is correct <input type="radio" value="0" name="correct"><br>
                        <input type="text" name="options[]"> is correct <input type="radio" value="1" name="correct"><br>
                        <input type="text" name="options[]"> is correct <input type="radio" value="2" name="correct"><br>
                        <input type="text" name="options[]"> is correct <input type="radio" value="3" name="correct"><br>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
        @endsection

        @section('js')
            <script>
                $(document).ready(function () {
                    $('#summernote').summernote({
                        placeholder: 'Enter content....',
                        tabsize: 2,
                        height: 100,
                        minHeight: 50,
                        maxHeight: 1000,
                        focus: true,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']],
                        ],
                        popover: {
                            image: [
                                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                                ['remove', ['removeMedia']]
                            ],
                            link: [
                                ['link', ['linkDialogShow', 'unlink']]
                            ],
                            table: [
                                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                            ],
                            air: [
                                ['color', ['color']],
                                ['font', ['bold', 'underline', 'clear']],
                                ['para', ['ul', 'paragraph']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture']]
                            ]
                        },
                        codemirror: {
                            theme: 'monokai'
                        }
                    });

                });
                // get
                var markupStr = $('#summernote').summernote('code');

                // set

                //$('#summernote').summernote('code', markupStr);

                // //check isEmpty
                $('#create_question').on('click', function () {
                    if ($('#summernote').summernote('isEmpty')) {
                        alert('Question content is empty. Please to enter the content');
                    }
                });

            </script>
@endsection
