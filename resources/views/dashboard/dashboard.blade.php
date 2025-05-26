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
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div
                            id="resultBox"
                            class="bg-light border p-4 mb-4 text-start fw-normal fs-6 position-relative"
                            >
                            Result will appear here...
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            id="resultBox2"
                            class="bg-light border p-4 mb-4 text-start fw-normal fs-6 position-relative"
                            >
                            TCP Dump will appear here...
                        </div>
                    </div>
                </div>
                

                <form id="modbusForm">
                    <div class="row g-3 mb-3">
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
                            <label class="form-label">Function Code</label>
                            <input type="number" name="function_code" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Register</label>
                            <input type="number" name="address" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Interval (In Seconds)</label>
                            <input type="number" name="interval" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Network interface</label>
                            <select class="form-control bs-select" data-live-search="false" id="interface" name="interface">
                                <option value="">Select Interface</option>
                                <option value="eth0">eth0</option>
                                <option value="lo">lo</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="stopBtn" class="btn btn-danger w-100">Stop</button>
                        </div>
                    </div>
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
        let intervalId = null;

        // $('.bs-select').selectpicker();

        $('#modbusForm').on('submit', function (e) {
            e.preventDefault();

            let ip_address = $('input[name="ip_address"]').val();
            let port = $('input[name="port"]').val();
            let fc = $('input[name="function_code"]').val();
            let deviceId = $('input[name="device_id"]').val();
            let address = $('input[name="address"]').val();
            let quantity = $('input[name="quantity"]').val();
            let interface = $('select[name="interface"]').val();
            let interval = $('input[name="interval"]').val() * 1000;

            // Clear any existing interval before starting a new one
            if (intervalId) clearInterval(intervalId);

            intervalId = setInterval(() => {
                $.ajax({
                    url: "{{ route('modbus.publish-read') }}",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        ip_address: ip_address,
                        port: port,
                        fc: fc,
                        device_id: deviceId,
                        address: address,
                        quantity: quantity,
                        _token: "{{ csrf_token() }}"
                    }),
                    success: function (res) {
                        console.log('✅ MQTT sent:', res);
                    },
                    error: function (err) {
                        let title   = 'Error sending to MQTT';
                        let message = 'An unknown error occurred';
                        
                        // Laravel validation errors come in err.responseJSON.errors
                        if (err.status === 422 && err.responseJSON?.errors) {
                            // flatten all messages into one string
                            const allErrors = Object
                            .values(err.responseJSON.errors)
                            .flat()
                            .join('<br>');
                            message = allErrors;
                            title   = 'Validation Error';
                        }
                        else if (err.responseJSON?.message) {
                            // other Laravel errors with a message property
                            message = err.responseJSON.message;
                        }

                        Swal.fire({
                        icon:  'error',
                        title: title,
                        html:  message,          // html so we can show <br> breaks
                        footer: err.responseJSON?.errors 
                            ? '<small>Please correct the highlighted fields</small>' 
                            : ''
                        });
                    }
                });
            }, interval);

            $.ajax({
                url: "{{ route('modbus.publish-tcpdump') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    mode: "1",
                    port: port,
                    interface: interface,
                    _token: "{{ csrf_token() }}"
                }),
                success: function (res) {
                    console.log('✅ MQTT sent:', res);
                },
                error: function (err) {
                    let title   = 'Error sending to MQTT';
                    let message = 'An unknown error occurred';
                    
                    // Laravel validation errors come in err.responseJSON.errors
                    if (err.status === 422 && err.responseJSON?.errors) {
                        // flatten all messages into one string
                        const allErrors = Object
                        .values(err.responseJSON.errors)
                        .flat()
                        .join('<br>');
                        message = allErrors;
                        title   = 'Validation Error';
                    }
                    else if (err.responseJSON?.message) {
                        // other Laravel errors with a message property
                        message = err.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon:  'error',
                        title: title,
                        html:  message,          // html so we can show <br> breaks
                        footer: err.responseJSON?.errors 
                        ? '<small>Please correct the highlighted fields</small>' 
                        : ''
                    });
                }
            });
        });

        $('#stopBtn').on('click', function () {
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
                console.log('🛑 Interval stopped.');
                Swal.fire({
                    icon:  'success',
                    title: "Success",
                    html:  "Process Stopped",      
                });
            }

            $.ajax({
                url: "{{ route('modbus.publish-tcpdump') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    mode: "0",
                    port: "502",
                    interface: "eth0",
                    _token: "{{ csrf_token() }}"
                }),
                success: function (res) {
                    console.log('✅ MQTT sent:', res);
                    Swal.fire({
                        icon:  'success',
                        title: "Success",
                        html:  "Process Stopped",      
                    });
                },
                error: function (err) {
                    let title   = 'Error sending to MQTT';
                    let message = 'An unknown error occurred';
                    
                    // Laravel validation errors come in err.responseJSON.errors
                    if (err.status === 422 && err.responseJSON?.errors) {
                        // flatten all messages into one string
                        const allErrors = Object
                        .values(err.responseJSON.errors)
                        .flat()
                        .join('<br>');
                        message = allErrors;
                        title   = 'Validation Error';
                    }
                    else if (err.responseJSON?.message) {
                        // other Laravel errors with a message property
                        message = err.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon:  'error',
                        title: title,
                        html:  message,          // html so we can show <br> breaks
                        footer: err.responseJSON?.errors 
                        ? '<small>Please correct the highlighted fields</small>' 
                        : ''
                    });
                }
            });
        });

        var $box = $('#resultBox')[0];
        var $box2 = $('#resultBox2')[0];
        // create the observer
        var mo = new MutationObserver(function(mutations){
            // whenever children change, scroll to bottom
            $box.scrollTop = $box.scrollHeight;
        });
        var mo2 = new MutationObserver(function(mutations){
            // whenever children change, scroll to bottom
            $box2.scrollTop = $box2.scrollHeight;
        });
        // start observing only direct child additions
        mo.observe($box, { childList: true });
        mo2.observe($box2, { childList: true });
    });

    let resultBox = "";
        window.Echo.channel('modbus-read-output')
            .listen('.output', function (e) {
                // console.log(e.payload);
                resultBox += `<p>${e.payload}</p>`;
                $('#resultBox').html(resultBox);
            });

    let resultBox2 = "";
        window.Echo.channel('modbus-tcpdump-output')
            .listen('.output', function (e) {
                // console.log(e.payload);
                resultBox2 += `<p>${e.payload}</p>`;
                $('#resultBox2').html(resultBox2);
            });
</script>
@endpush

@endsection
