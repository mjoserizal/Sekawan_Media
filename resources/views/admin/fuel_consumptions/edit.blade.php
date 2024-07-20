@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Konsumsi BBM</h3>
                            <a href="{{ route("admin.fuel_consumptions.index") }}"
                                class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="{{ route("admin.fuel_consumptions.update", $fuelConsumption) }}">
                                @csrf
                                @method("put")
                                <div class="form-group row border-bottom pb-4">
                                    <label for="car_id" class="col-sm-2 col-form-label">Nama Mobil</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="car_id" id="car_id">
                                            @foreach ($cars as $car)
                                                <option {{ $fuelConsumption->car_id == $car->id ? "selected" : "" }}
                                                    value="{{ $car->id }}">{{ $car->nama_mobil }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="quantity" class="col-sm-2 col-form-label">Kuantitas BBM (Liter)</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" class="form-control" name="quantity"
                                            value="{{ old("quantity", $fuelConsumption->quantity) }}" id="quantity">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="price" class="col-sm-2 col-form-label">Harga BBM (per Liter)</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" class="form-control" name="price"
                                            value="{{ old("price", $fuelConsumption->price) }}" id="price">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="date" class="col-sm-2 col-form-label">Tanggal Konsumsi</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="date"
                                            value="{{ old("date", $fuelConsumption->date) }}" id="date">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
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
