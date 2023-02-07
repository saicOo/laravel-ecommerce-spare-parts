@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            $.notify({
                // options
                message: '{{ $error }}'
            }, {
                // settings
                type: 'danger'
            });
            // Command: toastr["error"]("{{ $error }}")
        @endforeach
    </script>
@endif
