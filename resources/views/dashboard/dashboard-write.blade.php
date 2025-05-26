@extends('layouts.app')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('sidebar')
@include('layouts.navbar.sidebar')
@endsection

@section('body')
@include('layouts.add.main-body')
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                
                <div id="resultBox" class="bg-light border p-4 mb-4 text-start fw-normal fs-6">
                    Result will appear here...
                </div>

                <form id="modbusForm">
                    <div class="row g-3 mb-3">
                        {{-- <div class="col-md-6">
                            <label class="form-label">Function Code</label>
                            <input type="number" name="function_code" class="form-control" required>
                        </div> --}}
                        <div class="col-md-6">
                            <label class="form-label">Ip Address</label>
                            <input type="text" name="ip_address" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Port</label>
                            <input type="number" name="port" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Device Id</label>
                            <input type="number" name="device_id" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Register</label>
                            <input type="number" name="address" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Value</label>
                            <input type="number" name="value" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="/js/app.js"></script>

<script>
    $(document).ready(function () {
        $('#modbusForm').on('submit', function (e) {
            e.preventDefault();

            let ip_address = $('input[name="ip_address"]').val();
            let port = $('input[name="port"]').val();
            let address = $('input[name="address"]').val();
            let value = $('input[name="value"]').val();
            // let functionCode = $('input[name="function_code"]').val();
            let deviceId = $('input[name="device_id"]').val();

            $.ajax({
                url: "{{ route('modbus.publish-write') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    ip_address: ip_address,
                    port: port,
                    address: address,
                    // function_code: functionCode,
                    device_id: deviceId,
                    value: value,
                    _token: "{{ csrf_token() }}"
                }),
                success: function (res) {
                    console.log('✅ MQTT sent:', res);
                },
                error: function (err) {
                    console.error('❌ Error sending to MQTT:', err.responseJSON);
                }
            });
        });

        var $box = $('#resultBox')[0];
        // create the observer
        var mo = new MutationObserver(function(mutations){
        // whenever children change, scroll to bottom
        $box.scrollTop = $box.scrollHeight;
        });
        // start observing only direct child additions
        mo.observe($box, { childList: true });
    });

    let resultBox = "";
        window.Echo.channel('modbus-write-output')
            .listen('.output', function (e) {
                // console.log(e.payload);
                resultBox += `<p>${e.payload}</p>`;
                $('#resultBox').html(resultBox);
            });
</script>
@endpush

@endsection
