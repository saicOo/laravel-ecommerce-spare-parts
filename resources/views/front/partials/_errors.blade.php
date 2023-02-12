@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)

            Command: toastr["error"]("{{ $error }}")
            @endforeach
    </script>
@endif
