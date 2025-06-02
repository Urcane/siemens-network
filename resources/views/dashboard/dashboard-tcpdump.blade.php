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

                <form id="tcpdumpForm">
                    {{-- <input type="hidden" name="mode" value="0"> --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Port</label>
                            <input type="text" name="port" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary w-100" id="btnSubmit-tcp">Submit</button>
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
        $('#tcpdumpForm').on('submit', function (e) {
            e.preventDefault();

            let mode = "1";
            let port = $('input[name="port"]').val();

            $.ajax({
                url: "{{ route('modbus.publish-tcpdump') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    mode: mode,
                    port: port,
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

        $('#stopBtn').on('click', function (e) {
            e.preventDefault();

            let mode = "0";
            let port = $('input[name="port"]').val();

            $.ajax({
                url: "{{ route('modbus.publish-tcpdump') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    mode: mode,
                    port: port,
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
        })

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
        window.Echo.channel('modbus-tcpdump-output')
            .listen('.output', function (e) {
                // console.log(e.payload);
                resultBox += `<p>${e.payload}</p>`;
                $('#resultBox').html(resultBox);
                $('#resultBox').scrollTop(this.scrollHeight);
            });
</script>
@endpush

@endsection
