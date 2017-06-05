@extends('layouts.master')


@section('title', 'Upload Video')

@section('content')
<div class="container">
    <div class="row">
        <div id="file-upload" class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add Video</div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="form b-upload" method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Video Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" placeholder="Enter title" required>
                            <small id="titleHelp" class="form-text text-muted">Enter title for the video.</small>
                        </div>
                        <div class="form-group">
                            <label class="custom-file">
                                <input type="file" id="video" name="video" class="custom-file-input" required>
                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {

    });
</script>
@endpush