@extends('layouts.master')


@section('title', 'List All Videos')

@section('content')
    <div class="container">
    <div class="row">
        <div id="file-upload" class="col-md-12">
            <div class="alert text-center">
            </div>
            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="col-md-2">#</th>
                    <th class="col-md-2">Title</th>
                    <th class="col-md-2">Duration</th>
                    <th class="col-md-2">File size</th>
                    <th class="col-md-2">Format</th>
                    <th class="col-md-2">Bit rate</th>
                    <th class="col-md-2">Path</th>
                    <th class="col-md-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                <tr>
                    <th class="col-md-2" scope="row">{{ $video->id }}</th>
                    <td class="col-md-2">{{ $video->title }}</td>
                    <td class="col-md-2">{{ $video->duration }}</td>
                    <td class="col-md-2">{{ $video->size }}</td>
                    <td class="col-md-2">{{ $video->format }}</td>
                    <td class="col-md-2">{{ $video->bitRate }}</td>
                    <td class="col-md-2">{{ asset("storage/{$video->path}") }}</td>
                    <td class="col-md-2">
                        @if (in_array(auth()->user()->role->name, [
                            'ROLE_ADMIN',
                            'ROLE_EDIT'
                        ]))
                        <a class="like-btn" href="{{ route('videos.like', ['id' => $video->id]) }}">Like</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            {{ $videos->links() }}
        </div>
    </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(".like-btn").click(function (e) {
            e.preventDefault();
            let url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'POST',
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $(".alert").html(result.message);
                    $(".alert").addClass("alert-success");
                }
            });
        });
    });
</script>
@endpush