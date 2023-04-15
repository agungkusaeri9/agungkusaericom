
<link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title:'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 5000
        })
    </script>
@elseif(session('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title:'Failed!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 5000
        })
    </script>
@endif
