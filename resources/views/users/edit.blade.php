@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                            <a href="{{ route("admin.users.index") }}" class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="{{ route("admin.users.update", $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group row border-bottom pb-4">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old("name", $user->name) }}" id="name">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old("email", $user->email) }}" id="email">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password"
                                            class="form-control @error("password") is-invalid @enderror"
                                            placeholder="{{ __("Password") }}">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                            password</small>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="role" id="role">
                                            @foreach (["admin" => "Admin", "approval" => "Approval"] as $value => $label)
                                                <option {{ old("role", $user->role) == $value ? "selected" : null }}
                                                    value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
