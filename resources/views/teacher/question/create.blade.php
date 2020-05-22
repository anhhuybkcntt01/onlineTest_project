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
                    <form method="POST"
                          action="{{route('teacher.question.store',['room_id'=>$room->id,'examination_id'=>$examination->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        <textarea id="summernote" name="content_question"></textarea>
                        <input type="hidden" name="option" value="1" id="check">

                        <div class="form-group">

                            <label for="point" class="col-md-4 col-form-label text-md-right">Point</label>
                            <input id="point" type="number"
                                   class="form-control @error('point') is-invalid @enderror" name="point"
                                   value="{{ old('point') }}" autocomplete="point" autofocus>

                            @error('point')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="radio" value="0" name="correct"> A:
                                <input class="form-control"
                                       type="text" name="options[]"
                                       value="{{ old('options[]') }}"
                                       required
                                       autocomplete="options[]"
                                       autofocus>
                            </label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" value="1" name="correct"> B: <input class="form-control"
                                                                                           type="text" name="options[]"
                                                                                           value="{{ old('options[]') }}"
                                                                                           required
                                                                                           autocomplete="options[]"
                                                                                           autofocus></label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" value="2" name="correct"> C: <input class="form-control"
                                                                                           type="text" name="options[]"
                                                                                           value="{{ old('options[]') }}"
                                                                                           required
                                                                                           autocomplete="options[]"
                                                                                           autofocus></label>
                        </div>
                        <div class="form-group">
                            <label><input type="radio" value="3" name="correct"> D: <input class="form-control"
                                                                                           type="text" name="options[]"
                                                                                           value="{{ old('options[]') }}"
                                                                                           required
                                                                                           autocomplete="options[]"
                                                                                           autofocus></label>
                        </div>


                        <div class="form-group">
                            <button type="submit" id="create_question" class="btn btn-primary"
                                    style="margin-right: 100px">
                                Create More Question
                            </button>

                            <button type="submit" id="show_all_question" class="btn btn-primary"
                                    style="margin-right: 100px">
                                show all Question
                            </button>

                        </div>


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

                // $('#summernote').summernote('code', markupStr);

                // //check isEmpty and check validate by JS
                $('#create_question').on('click', function (event) {
                    if ($('#summernote').summernote('isEmpty')) {
                        alert('Question content is empty. Please to enter the content');
                        event.preventDefault()
                    }
                    if (!$("input[name='correct']").is(':checked')) {
                        alert('Choose question\'s correct answer');
                        event.preventDefault()
                    }
                    let point = $('#point').val();
                    if(point == ''){
                        alert('Enter question\'s point ');
                        event.preventDefault()
                    }

                });

                $('#show_all_question').on('click', function (event) {
                    if ($('#summernote').summernote('isEmpty')) {
                        alert('Question content is empty. Please to enter the content');
                        event.preventDefault()
                    }
                    if (!$("input[name='correct']").is(':checked')) {
                        alert('Choose question\'s correct answer');
                        event.preventDefault()
                    }
                    let point = $('#point').val();
                    if(point == ''){
                        alert('Enter question\'s point ');
                        event.preventDefault()
                    }
                    $('#check').val(2);
                });

            </script>
@endsection
