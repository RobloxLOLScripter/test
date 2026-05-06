@extends('layouts.admin')

@section('title')
    Velion Extension
@endsection

@section('content-header')
    <h1>Velion Extension<small>Configure the Velion theme.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Velion</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Theme Settings</h3>
                </div>
                <form action="{{ route('admin.extensions.velion.update') }}" method="POST">
                    <div class="box-body">
                        <p>The external editor has been removed. You can now configure basic settings here or via the database.</p>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Border Radius</label>
                                <div>
                                    <input type="number" name="border_radius" class="form-control" value="{{ $blueprint->dbGet('velion', 'border_radius') }}" />
                                    <p class="text-muted"><small>Global element border radius.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-primary pull-right">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
