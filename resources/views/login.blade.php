@extends('layout')

@section('main')
    <form action="{{ route('loginSubmit') }}" method="POST" class="w-50 mx-auto mt-5 form">
        @csrf
        @method('POST')
        <div class="mb-3 row">
            <label for="Email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="Email" placeholder="Enter your email">
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword"
                    placeholder="Enter your password">
                    @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success w-100 mt-3">Submit</button>
    </form>
@endsection
