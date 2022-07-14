@extends('backend.layouts.default')
@section('page_title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quiz Participants</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($questionAnswers as $questions)

                    <div class="row input_row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Answer By </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    {{ $questions->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row input_row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Question </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    {{ $questions->questions->question }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row input_row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">User Answer </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <?php //echo '<pre>'; var_dump($questions->questions->options) ?>
                                        @foreach($questions->questions->options as $opt)
                                            @php
                                                // echo '<pre>';
                                                // var_dump($opt->option);   
                                            @endphp
                                            {{-- {{ $opt->option }} --}}
                                            @if ($questions->option_id == $opt->id)
                                                {{ $opt->option }}, 
                                            @endif
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row input_row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Right Answer </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    @foreach($questions->questions->options as $opt)
                                        @php
                                            // echo '<pre>';
                                            // var_dump($opt->is_right_option);   
                                        @endphp
                                        @if ($opt->is_right_option == 1)
                                            {{ $opt->option }}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row input_row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Right Answer </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    @if($questions->is_right == 1)
                                        <button class="btn btn-sm btn-success">Correct</button>
                                    @else
                                        <button class="btn btn-sm btn-danger">Wrong</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                @endforeach


                <div class="table-responsive">
                    <div>Showing
                        {{ ($questionAnswers->currentpage()-1) * $questionAnswers->perpage()+1}} to
                        {{(($questionAnswers->currentpage()-1) * $questionAnswers->perpage())+$questionAnswers->count()}} of
                        {{$questionAnswers->total()}} records
                    </div>

                    {{ $questionAnswers->links() }}
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection			
           