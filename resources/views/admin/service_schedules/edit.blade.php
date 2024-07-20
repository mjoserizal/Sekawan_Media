@extends("layouts.app")

@section("content")
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Jadwal Servis</h3>
                            <a href="{{ route("admin.service_schedules.index") }}"
                                class="btn btn-success shadow-sm float-right">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="{{ route("admin.service_schedules.update", $serviceSchedule) }}">
                                @csrf
                                @method("put")
                                <div class="form-group row border-bottom pb-4">
                                    <label for="car_id" class="col-sm-2 col-form-label">Nama Mobil</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="car_id" id="car_id">
                                            @foreach ($cars as $car)
                                                <option {{ $serviceSchedule->car_id == $car->id ? "selected" : "" }}
                                                    value="{{ $car->id }}">{{ $car->nama_mobil }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="service_date" class="col-sm-2 col-form-label">Tanggal Servis</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="service_date"
                                            value="{{ old("service_date", $serviceSchedule->service_date->format("Y-m-d")) }}"
                                            id="service_date">
                                    </div>
                                </div>
                                <div class="form-group row border-bottom pb-4">
                                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="4">{{ old("description", $serviceSchedule->description) }}</textarea>
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
