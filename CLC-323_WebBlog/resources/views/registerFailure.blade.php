<!--View page that shows when a user fails to register -->
@extends('layouts.appmaster')
@section('head','Registration Failed')
@section('title', 'There was an error registering your account')
@section('content')
@isset($result)
	{{$result}}
@endisset
<p>Click <a href="Register">here</a> to try again.</p>
@endsection
