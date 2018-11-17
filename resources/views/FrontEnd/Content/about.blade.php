@extends("FrontEnd.Layout.Login.master")

@section("title")
    {{ $title }}
@endsection


@section("content")
    <div class="text-center" style="color:white">
        <h3 style="color:#fff">{{ $title }}</h3>
        <div class="container"><div>{{ $about }}</div></div>
    </div>
@endsection