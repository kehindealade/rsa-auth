@extends('layouts.app')

@section('content')
<form action="{{route('post.secure')}}" method="post">
@csrf
@if(Session::has('errors'))
                      
                      @foreach(Session::get("errors")->all() as $error)
                     <div class="alert alert-danger">
                     <strong>{{$error}}</strong>
                     </div>
                     
             @endforeach
             @endif

<input type="text" name="payload">
<input type="submit" value="Send Payload">
</form>
@endsection