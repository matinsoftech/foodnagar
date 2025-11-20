<livewire:scripts />
@livewireChartsScripts
<x-livewire-alert::scripts />
{{-- @bukScripts(true) --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/init-alpine.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2({ width: '100%' });
</script>

@include('layouts.partials.notification')
