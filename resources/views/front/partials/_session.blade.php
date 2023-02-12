@if (session('success'))
    <script>
        Command: toastr["success"]("{{ session('success') }}")
    </script>
@endif
