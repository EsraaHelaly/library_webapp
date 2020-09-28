<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("student's details") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <table class="table table-bordered">


    <tr>
        <td><b>user id</b></td>
        <td>{{$users->id}}</td>

    </tr>
    <tr>
        <td><b>user name</b></td>
        <td>{{$users->name}}</td>

    </tr>
    <tr>
        <td><b>user email</b></td>
        <td>{{$users->email}}</td>

    </tr>
    <tr>
        <td><b>teams</b></td>
        <td>{{$users->current_team_id}}</td>
    </tr>

    <tr>
        <td><b>photo</b></td>
        <td>{{$users->profile_photo_path}}</td>

    </tr>
    <tr>
        <td><b>created at</b></td>
        <td>{{$users->created_at}}</td>

    </tr>

    <tr>
        <td><b>updated at</b></td>
        <td>{{$users->updated_at}}</td>

    </tr>

    
    <table>
    <td><a href="{{URL::previous()}}" class="btn btn-primary">back </a></td>       

        </div>
    </div>
</x-app-layout>