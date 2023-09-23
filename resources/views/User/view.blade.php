@extends('layout')
@section('content')
<div class="container mt-4">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>
                    <a href="{{route('edit.post',$post->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fas fa-edit"></i> Edit</a>
                    <button class="btn btn-danger btn-sm delete-post" data-id="{{$post->id}} "><i class="fas fa-trash"></i> Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('footer-script')
<script>
    $('.delete-post').on('click', function () {
        if (confirm('Are you sure you want to delete this Product')) {
            var id = $(this).data('id');
            $.ajax({
                url: '{{route("delete.post")}}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function (data) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors if any
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
@endpush

