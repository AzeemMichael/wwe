@extends('layouts.master')


@section('title', 'List All Users')

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
                            <th class="col-md-2">Name</th>
                            <th class="col-md-2">Email</th>
                            <th class="col-md-2">Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th class="col-md-2" scope="row">{{ $user->id }}</th>
                                <td class="col-md-2">{{ $user->name }}</td>
                                <td class="col-md-2">{{ $user->email }}</td>
                                <td class="col-md-2">{{ $user->role->name ?? 'na' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
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