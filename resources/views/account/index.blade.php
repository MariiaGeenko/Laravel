@extends('layouts.app')
@section('content')
    <div class="col-8 offset-2">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <br>
        @if(Auth::user()->is_admin === true)
            <a href="{{ route('admin.index') }}">in Admin panel</a>
        @endif
    </div>
@endsection
