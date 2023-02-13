@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endpush
