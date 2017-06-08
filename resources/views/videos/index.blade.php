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
                        @if (in_array(auth()->user()->role->name, [
                            'ROLE_ADMIN',
                            'ROLE_EDIT',
                            'ROLE_READ'
                        ]))
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal" data-link="{{ asset("storage/{$video->path}") }}">Play</button>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <video width="320" height="240" controls>
                        <source src="" type="video/mp4">
                        <source src="" type="video/ogg">
                        <!-- Fallback object using Flow Player -->
                        <object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" width="640" height="360">
                            <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
                            <param name="allowFullScreen" value="true" />
                            <param name="wmode" value="transparent" />
                            <param name="flashVars" value="config={'playlist':[ 'linktoposter.jpg',{'url':'linktomovie.mp4','autoPlay':false}]}" />
                            <img alt="My Movie" src="linktoposter.jpg" width="640" height="360" title="No video playback capabilities, please download the video below." />
                        </object>
                        <!-- Fallback Text -->
                        Your browser does not appear to support a browser. Please download the video below.
                    </video>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
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

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var link = button.data('link') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body source').attr('src', link);
        })
    });
</script>
@endpush