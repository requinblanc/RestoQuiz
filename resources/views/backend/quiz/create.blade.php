@extends('backend.layouts.default')

@section('page_title', 'Create Quiz')


@section('content')


<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Recent Quiz</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form method="post" action="{{ route('quiz.store') }}" class="form-inline">
                    
                    <form method="post" action="" class="form-inline">
                        <div class="form-group">
                            <label class="col-form-label name_label">Quiz Name</label>
                            <input type="text" name="name" class="form-control name_input" placeholder=" Enter Quiz Name">
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success btn_create">Create Quiz</button>
                    </form>
                </form>
                <div class="ln_solid"></div>

                @if(empty($quizs->count()))
                    <p>No Quiz found.</p>
                @else
                   
                @endif
            </div>
        </div>
    </div>
</div>
        

@endSection