@extends('layouts.auth')
@section('title', 'Multiple-Choice Questions')
@push('styles')

    <style>
        .card-body{
            height: 95vh!important;
        }

        {!! $availableStyles->style !!}

    </style>

@endpush

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto mt-4 ">
                <div class="card text-start">

                    <div class="card-body position-relative shadow border-0">
                        <div class="card-title" >Topic: {{$passage['topic']??null}}</div>
                        {{--  <h1>{{$passage['text_name']??null}}</h1>--}}


{{--                        <div class="overflow-x-auto" style="height: 80vh">--}}
                            {!! $passage['content'] !!}
{{--                        </div>--}}


                        <div class="   position-absolute bottom-0  d-flex justify-content-between mb-2" style="width: 98%">
                             <div></div>

                            <a
                                href="{{route('dynamic.questions.show',['passage'=>  count($passage->questions) > 0? base64_encode($passage->id):null,'initial'=>$isInitial??null])}}"
                                type="button" class="btn btn-primary">Next</a>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush

