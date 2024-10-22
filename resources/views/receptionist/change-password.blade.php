@extends('receptionist.dashboard')
@section('content')

<form class="mt-4 mx-4" action="{{route('receptionist.change-password', $user)}}" class="" method="post">

    @include('change-password')


@endSection
