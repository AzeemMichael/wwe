@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            @if (in_array(auth()->user()->role->name, [
                                'ROLE_ADMIN',
                                'ROLE_EDIT',
                                'ROLE_READ',
                                'ROLE_DELETE'
                            ]))
                            <a href="{{ route('videos.index') }}" class="thumbnail">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List Videos
                            </a>
                            @endif
                        </div>
                        <div class="col-xs-6 col-md-3">
                            @if (in_array(auth()->user()->role->name, [
                                'ROLE_ADMIN',
                                'ROLE_EDIT'
                            ]))
                            <a href="{{ route('videos.create') }}" class="thumbnail">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Videos
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
