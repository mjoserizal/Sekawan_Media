@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Semua Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route("admin.bookings.export") }}" class="btn btn-primary"
                                style="margin-bottom: 20px">Export to Excel</a>
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Alamat Lengkap</th>
                                            <th>Nomer HP/Whatsap</th>
                                            <th>Mobil</th>
                                            <th>Sewa</th>
                                            <th>Total</th>
                                            <th>Kilometer</th>
                                            <th>Pemakaian Bensin (Liter)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $booking->nama_lengkap }}</td>
                                                <td>{{ $booking->alamat_lengkap }}</td>
                                                <td>
                                                    <a href="https://wa.me/{{ $booking->nomer_wa }}"
                                                        target="_blank">{{ $booking->nomer_wa }}</a>
                                                </td>
                                                <td>{{ $booking->car->nama_mobil }}</td>
                                                <td>{{ $booking->rent_days }} Hari</td>
                                                <td>Rp{{ number_format($booking->total_price, 0, ",", ".") }}</td>
                                                <td>{{ $booking->kilometers }}</td>
                                                <td>{{ $booking->fuel_used }}</td>
                                                <td>
                                                    @if ($booking->status == "pending" && $booking->approval_count < 2)
                                                        @if (auth()->user()->role == "approval")
                                                            @if ($booking->approval_count == 1)
                                                                <span class="text-info">Menunggu disetujui oleh admin</span>
                                                            @else
                                                                <form
                                                                    action="{{ route("admin.bookings.approve", $booking->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method("PATCH")
                                                                    <button type="submit"
                                                                        class="btn btn-success">Approve</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route("admin.bookings.reject", $booking->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method("PATCH")
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Reject</button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <form
                                                                action="{{ route("admin.bookings.approve", $booking->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method("PATCH")
                                                                <button type="submit"
                                                                    class="btn btn-success">Approve</button>
                                                            </form>
                                                            <form
                                                                action="{{ route("admin.bookings.reject", $booking->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method("PATCH")
                                                                <button type="submit"
                                                                    class="btn btn-danger">Reject</button>
                                                            </form>
                                                        @endif
                                                    @elseif ($booking->status == "approved")
                                                        <span class="text-success">Disetujui</span>
                                                    @elseif ($booking->status == "rejected")
                                                        <span class="text-danger">Ditolak</span>
                                                    @elseif ($booking->status == "completed")
                                                        <span class="text-success">Selesai</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route("admin.bookings.edit", $booking->id) }}"
                                                            class="btn btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form onclick="return confirm('Are you sure?')"
                                                            action="{{ route("admin.bookings.destroy", $booking->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method("DELETE")
                                                            <button class="btn btn-sm btn-danger" type="submit">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        @if ($booking->status == "approved" && $booking->status != "completed")
                                                            <form
                                                                action="{{ route("admin.bookings.complete", $booking->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method("PATCH")
                                                                <button type="submit" class="btn btn-info"
                                                                    title="Mark as Completed">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Data Kosong !</td>
                                            </tr>
                                        @endforelse
                                </table>
                            </div>
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

@push("style-alt")
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush

@push("script-alt")
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $("#data-table").DataTable();
    </script>
@endpush
