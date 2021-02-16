@extends('layouts.appmaster')
@section('head','Note Search Failed')
@section('title', 'Search Error')
@section('content')
@isset($result)
	{{$result}}
@endisset
<p>There was an error finding results for your search :( Click <a href="BlogSearch">here</a> to try again.</p>
@endsection
