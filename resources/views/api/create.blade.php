
@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('blog.post.post') }}">
        {{ csrf_field() }}
        <table>
            <tr>
                <td><label for="title">Title</label></td>
                <td><input  style="width: 500px" type="text" name="title" id="title" value="{{ old('title') }}"></td>
            </tr>
            <tr>
                <td><label for="category">Category</label></td>
                <td>
                    <select  style="width: 500px" name="category" id="category">

                        <option value="">Select</option>
                        @foreach($category as $cate)
                            <option value="{{ $cate['id']}}">{{ $cate['name'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="content">Content</label> </td>
                <td><textarea  style="width: 500px; height: 100px" id="content" name="content">{{ old('content') }}</textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Insert</button>
                    <button><a style="text-decoration: none" href="{{ route('blog.post.index') }}">Cancel</a></button>
                </td>
            </tr>
        </table>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
@endsection
