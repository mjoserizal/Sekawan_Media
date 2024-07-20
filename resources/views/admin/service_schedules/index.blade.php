@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Jadwal Servis</h3>
                            <a href="{{ route("admin.service_schedules.create") }}"
                                class="btn btn-primary shadow-sm float-right">
                                <i class="fa fa-plus"></i> Tambah Jadwal Servis
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Mobil</th>
                                        <th>Tanggal Servis</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($serviceSchedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->id }}</td>
                                            <td>{{ $schedule->car->nama_mobil }}</td>
                                            <td>{{ $schedule->service_date }}</td>
                                            <td>{{ $schedule->description }}</td>
                                            <td>
                                                <a href="{{ route("admin.service_schedules.edit", $schedule) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form action="{{ route("admin.service_schedules.destroy", $schedule) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
