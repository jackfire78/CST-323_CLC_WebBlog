@extends('layouts.appmaster')
@section('head','Blog Submittion Failed')
@section('title', 'There was an error submitting your blog...sorry about that')
@section('content')
@isset($result)
	{{$result}}
@endisset
<br/>
<h1>Sorry, we couldn't find any posts by you or an error has occured internally.</h1>
<p>Click <a href="BlogSubmit">here</a> to try again.</p>
@endsection
