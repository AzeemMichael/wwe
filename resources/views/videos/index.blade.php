@extends('layouts.master')


@section('title', 'List All Videos')

@section('content')
    <div class="container">
    <div class="row">
        <div id="file-upload" class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>File size</th>
                    <th>Format</th>
                    <th>Bit rate</th>
                    <th>Path</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                <tr>
                    <th scope="row">{{ $video->id }}</th>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->duration }}</td>
                    <td>{{ $video->size }}</td>
                    <td>{{ $video->format }}</td>
                    <td>{{ $video->bitRate }}</td>
                    <td>{{ asset("storage/{$video->path}") }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $videos->links() }}
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