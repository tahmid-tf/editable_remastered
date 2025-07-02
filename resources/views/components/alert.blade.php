@if(session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition
        class="alert_div"
    >
        <div class="alert-success">
            <span class="badge-success">Success</span>
            <span>Style Created Successfully!</span>
        </div>
    </div>

@endif

@if(session('danger'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="alert_div"
    >
        <div class="alert-danger">
            <span class="badge-danger">Success</span>
            <span>Style Created Successfully!</span>
        </div>
    </div>
@endif
