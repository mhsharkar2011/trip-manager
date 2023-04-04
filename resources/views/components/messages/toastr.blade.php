@if(Session::has('success'))
    <script>
        $(document).ready(function() {
            toastr.success("{{ Session::get('success') }}");
        });
    </script>
@endif
@if(Session::has('error'))
    <script>
        $(document).ready(function() {
            toastr.error("{{ Session::get('error') }}");
        });
    </script>
@endif
