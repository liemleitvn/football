@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if($message = Session::get('status'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif
    @if(isset($result))
        @if(isset($result['errors']))
            <div class="alert alert-danger">
                {{ $result['errors'] }}
            </div>
        @else
            <div style="margin: 20px">
                <button><a style="text-decoration: none" href="{{ route('blog.post.create') }}">Insert</a></button>
            </div>
            <table style="margin: 20px">
                <tr >
                    <th>No</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>User</th>
                    <th>Category</th>
                </tr>
                <?php $index = 1 ?>
                @foreach ($result as $post)
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $post['title'] }}</td>
                        <td>{{ $post['content'] }}</td>
                        <td>{{ $post['user'] }}</td>
                        <td>{{ $post['category'] }}</td>
                        <td><a href="{{ url('blog/posts/update/'.$post['id']) }}">Edit</a></td>
                        <td><a href="{{ url('blog/posts/delete/'.$post['id']) }}">Delete</a></td>
                    </tr>
                    <?php $index++ ?>
                @endforeach
            </table>
        @endif
    @else
        <p>Khong ton tai</p>
    @endif
@endsection
