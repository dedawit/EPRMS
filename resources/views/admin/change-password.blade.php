@extends('admin.dashboard')
@section('content')

<form class="mt-4" action="{{route('admin.change-password', $user)}}" class="" method="post">


    @include('change-password')


@endSection
