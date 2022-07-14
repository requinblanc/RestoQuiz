@extends('backend.layouts.default')

@section('page_title', 'Manage Roles')


@section('content')

@if(! Auth::user()->can('Administrateur_role'))
    @include('errors.401')
@else
    <div class="x_panel">
        <div class="x_title">
            <h2>
                Create Roles
            </h2>
            <a href="{{ route('role.index') }}" class="btn btn-success pull-right">List Roles</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="POST" action="{{ route('role.update', $role->id) }}" class="form-horizontal">
                <input type="hidden" name="_method" value="put" />
                <div class="item form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Role Name <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="name" value="{{ old('name', ucwords($role->name)) }}" required="required" disabled placeholder="Role name" class="form-control">
                    </div>
                </div>

                
                <hr>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('role.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endif

@endSection