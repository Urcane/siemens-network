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

                <form id="pingForm">
                    <input type="hidden" name="mode" value="0">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Ip</label>
                            <input type="text" name="ip" class="form-control" required>
                        </div>
                        <div class="col-md-6 m-auto">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="isActiveSwitch" name="is_active_checkbox" checked>
                                    <label class="form-check-label" for="isActiveSwitch">Active</label>
                            </div>
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
        $('#pingForm').on('submit', function (e) {
            e.preventDefault();

            $(this).find('input[name="mode"]').remove();

            // Append correct value based on checkbox
            if ($('#isActiveSwitch').is(':checked')) {
                $(this).append('<input type="hidden" name="mode" value="1">');
            } else {
                $(this).append('<input type="hidden" name="mode" value="0">');
            }

            let mode = $('input[name="mode"]').val();
            let ip = $('input[name="ip"]').val();

            $.ajax({
                url: "{{ route('ping.send') }}",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    mode: mode,
                    ip: ip,
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
        window.Echo.channel('ping-output')
            .listen('.output', function (e) {
                // console.log(e.payload);
                resultBox += `<p>${e.payload}</p>`;
                $('#resultBox').html(resultBox);
                $('#resultBox').scrollTop(this.scrollHeight);
            });
</script>
@endpush

@endsection
