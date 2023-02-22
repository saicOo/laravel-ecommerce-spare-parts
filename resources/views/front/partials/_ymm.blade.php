<!--YMM Dropdown-->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="text-uppercase m-0">@lang('site.Select Your Vehicle')</h2>
                </div>
            </div>
        </div>
        <form action="#" method="get" class="ymm-form">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="d-flex align-items-center items">
                        <span class="number">1</span>
                        <select name="make" id="t_make" class="form-control border-0">
                            <option disabled selected>{{ __('site.choose') }} {{ __('site.factory') }}</option>
                            @foreach ($factoryCars as $factoryCar)
                            <option value="{{$factoryCar->id}}">{{$factoryCar->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="d-flex align-items-center items">
                        <span class="number">2</span>
                        <select name="model" id="t_model" class="form-control border-0" disabled>
                            <option disabled selected>{{ __('site.choose') }} {{ __('site.car') }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="d-flex align-items-center items">
                        <span class="number">3</span>
                        <select name="year" id="t_year" class="form-control border-0" disabled>
                            <option disabled selected>{{ __('site.choose') }} {{ __('site.year') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <button type="submit" id="t_search_button"
                        class="btn btn-primary w-100 btn-lg">@lang('site.search')</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End YMM Dropdown-->
@push('js')
<script type="text/javascript">
    $(document).on('change', '#t_make', function() {
        factoryCarId = $(this).val();
        console.log(factoryCarId);
        $.ajax({
            url: `{{route('api-car.index')}}`,
            dataType: "json",
            data: {
                "factoryCarId": factoryCarId,
                "_token": "{{ csrf_token() }}"
            },
            method: "get",
            success: function(data) {
                console.log(data);
                var cars = '<option disabled selected>{{ __('site.choose') }} {{ __('site.car') }}...</option>';
                var arr = data;
                for (var i = 0; i < arr.length; i++) {
                    cars += '<option value="' + arr[i].id + '">' + arr[i].name + '</option>';
                }
                $("#t_model").html(cars);
                changeModelVehicle(true,false,false);
            }
        });

    }); // change factory

    $(document).on('change', '#t_model', function() {
        var  carId = $(this).val();
        console.log(carId);
        var url = `{{route('api-car.show',':carId')}}`;
        url = url.replace(':carId', carId);
        $.ajax({
            url: url,
            dataType: "json",
            method: "get",
            success: function(data) {
                console.log(data);
                var years =
                    '<option value="" disabled selected>{{ __('site.choose') }} {{ __('site.year') }}...</option>';
                var arr = data;
                for (var i = arr.end_year; i > arr.start_year; i--) {
                    years += '<option value="' + i + '">' + i + '</option>';
                }
                $("#t_year").html(years);
                $("#t_year").attr("disabled", false);
                changeModelVehicle(false,carId,false);
            }
        });
    });// change car

    $(document).on('change', '#t_year', function() {
        var  year = $(this).val();
        changeModelVehicle(false,false,year);
    });// change year

    $(document).on('click', '#t_search_button', function(e) {
        e.preventDefault();
        $('#filterForm').submit();
    });// change year

    function changeModelVehicle(make,model,year) {

        if (make) {
            $("#t_model").attr("disabled", false);
            $("#t_year").attr("disabled", true);
            $("#f_year").val('');
            $("#f_car_id").val('')
        } else if (model) {
            $("#f_car_id").val(model);
        } else if (year) {
            $("#f_year").val(year);
        } else {
        console.log('error');
        }
    }
</script>
@endpush
