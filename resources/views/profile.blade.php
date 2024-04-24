@extends('partials.header')

@section('content')
<div class="container" style="padding-top: 9em;padding-bottom:9em">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <!-- Profile Picture Row -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="current_profile_picture" class="form-label">Current Profile Picture</label>
                            @if ($user->image)
                                <img src="{{ asset('uploads/users/' . $user->image) }}" alt="Profile Picture" class="img-thumbnail">
                            @else
                                <p>No profile picture available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Profile Update Form -->
                    <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="image">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
