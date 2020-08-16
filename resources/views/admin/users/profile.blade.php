<x-admin-master>
    @section('content')
        <h1>User Profile</h1>
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img class="img-profile rounded-circle" src="{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                            id="username"
                            value="{{$user->username}}"
                        >
                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                            id="name"
                            value="{{$user->name}}"
                        >
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            type="text"
                            name="email"
                            class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                            id="email"
                            value="{{$user->email}}"
                        >
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                            id="password"
                        >
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Password</label>
                        <input
                            type="password"
                            name="password-confirmation"
                            class="form-control {{$errors->has('password-confirmation') ? 'is-invalid' : ''}}"
                            id="password-confirmation"
                        >
                        @error('password-confirmation')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
