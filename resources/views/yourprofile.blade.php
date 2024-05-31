@extends('layouts.app')

@section('title', 'Your Profile')

@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container profile-container">
    <h1 class="profile-header">Your Profile</h1>
    <table class="profile-table table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td><img src="{{ asset($user->image) }}" alt="Profile Image" class="profile-image"></td>
        </tr>
    </table>
</div>
@endsection
