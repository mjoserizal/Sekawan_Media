@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Booking</h3>
                            <a href="{{ route("admin.bookings.index") }}" class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="{{ route("admin.bookings.update", $booking) }}">
                                @csrf
                                @method("put")
                                <div class="form-group row border-bottom pb-4">
                                    <label for="car_id" class="col-sm-2 col-form-label">Mobil</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="car_id" id="car_id">
                                            @foreach ($cars as $car)
                                                <option value="{{ $car->id }}"
                                                    {{ $car->id == $booking->car_id ? "selected" : "" }}>
                                                    {{ $car->nama_mobil }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="kilometers" class="col-sm-2 col-form-label">Kilometers</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="kilometers"
                                            value="{{ old("kilometers", $booking->kilometers) }}" id="kilometers"
                                            step="0.01">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="fuel_used" class="col-sm-2 col-form-label">Fuel Used (Liters)</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="fuel_used"
                                            value="{{ old("fuel_used", $booking->fuel_used) }}" id="fuel_used"
                                            step="0.01">
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
