@extends('layouts.app')

@section('title', 'Profile Settings')

@section('styles')
    <link href="{{ asset('css/profilesetting.css') }}" rel="stylesheet">
@endsection

@section('contents')
<main>
    <form action="{{route('profile.change')}}" method="POST" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
        @csrf
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <input type="file" value="{{ Auth::user()->image }}" name="image">
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Name</label><input type="name" class="bg-light form-control" placeholder="" value="{{ Auth::user()->name }}" name="name"></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="email" class="bg-light form-control" placeholder="" value="{{ Auth::user()->email }}" name="email"></div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button">Save Profile</button>
                        <a href="{{url('medicine.home')}}" class="btn border profile-button">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
