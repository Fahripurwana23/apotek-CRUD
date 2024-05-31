@extends('layouts.main')

@section('title', 'Change Password')

@section('contents')
<div class="form-container">
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        @if($errors->any())
            <ul class="warning">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" required>
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" required>
        <label for="new_password_confirmation">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" required>
        <button type="submit">Change Password</button>
        <a href="{{ url('medicine.home') }}" class="btn">Cancel</a>
    </form>
</div>
@endsection
