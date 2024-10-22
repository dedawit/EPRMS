@extends('admin.dashboard')
@section('content')

<div class="container p-4 padding-shrink">
    <div class="row">
        @include('success-message')
    </div>
    <div class="row">
        <div class="row mb-2">
            <form action="{{route('admin.employee-list', $user->id)}}" method='GET' class="mt-2 searcher">
                <input placeholder="Search..." class="form-control w-100 mx-2 d-block" type="text" name="search">
                <button class="btn btn-primary mx-2 d-block" type="submit">Search</button>
            </form>
        </div>
        <a href="{{ route('admin.show-employee', $user->id) }}" class="btn btn-primary max-40">+ Create Account</a>
    </div>
    <div class=" row ">
        <div class="overflow-x-auto">


            <table   class="table-container">
                <thead>
                    <tr class="table-header">
                        <th class="border">No.</th>
                        <th class="border">Full Name</th>
                        <th class="border">Date of Birth</th>
                        <th class="border">Date of Registration</th>
                        <th class="border">Role</th>
                        <th class="border">Edit</th>
                    </tr>
                </thead>

                    @foreach($otherUsers as $key=>$other)
                    <tbody>
                    <tr class="table-body">
                        <td class="border-black">{{$key+1}}</td>
                        <td class="border-black">{{$other->first_name." ".$other->father_name." ".$other->grand_father_name}}</td>
                        <td class="border-black">{{$other->date_of_birth}}</td>
                        <td class="border-black">{{$other->created_at->format('Y-m-d')}}</td>
                        <td class="border-black">{{$other->role}}</td>
                        <td class="border-black">
                            <a href="{{route('admin.edit-employee', [$user->id, $other->id])}}" class="btn btn-primary btn-blue my-2 mx-2">Edit</a>
                        </td>
                    </tr>

                </tbody>
                @endforeach
            </table>
        </div>


    </div>
    <div class="my-2"></div>
</div>
@endSection
