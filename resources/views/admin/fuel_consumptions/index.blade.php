@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Konsumsi BBM</h3>
                            <a href="{{ route("admin.fuel_consumptions.create") }}"
                                class="btn btn-success shadow-sm float-right"> <i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Mobil</th>
                                        <th>Konsumsi BBM</th>
                                        <th>Harga BBM/Liter</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fuelConsumptions as $consumption)
                                        <tr>
                                            <td>{{ $consumption->id }}</td>
                                            <td>{{ $consumption->car->nama_mobil ?? "N/A" }}</td>
                                            <td>{{ $consumption->quantity }}</td>
                                            <td>{{ $consumption->price }}</td>
                                            <td>{{ $consumption->date }}</td>
                                            <td>
                                                <a href="{{ route("admin.fuel_consumptions.edit", $consumption->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <form
                                                    action="{{ route("admin.fuel_consumptions.destroy", $consumption->id) }}"
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
