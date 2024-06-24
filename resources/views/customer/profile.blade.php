@extends('layouts.customer.app')

@section('content')
    <div class="card p-3">
        <div class="card-title">
            <h4 class="text-center">Profile</h4>
        </div>

        <div class="card-body">
            <div class="text-center mb-4">
                <img src="{{ asset('images/' . auth()->user()->image) }}" alt="profile image" height="200"
                    class="rounded-circle">
                <form action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data"
                    class="mt-3">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="image" name="image">
                        <button class="btn btn-secondary" type="submit">Change Image</button>
                    </div>
                </form>
            </div>

            <div class="card px-4 py-4">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <fieldset class="text-left">
                        <legend>Profile</legend>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email', auth()->user()->email) }}" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Name" value="{{ old('name', auth()->user()->name) }}" name="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
