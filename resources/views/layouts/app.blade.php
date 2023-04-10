<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Record Management System</title>

  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
  @stack('styles')
</head>

<body>
  @yield('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

  <script>
    feather.replace();

    $(function() {
      $('.datatable').DataTable();

      $('.select2').select2({
        theme: 'bootstrap-5',
        width: $( this )
          .data( 'width' ) ? $( this )
          .data( 'width' ) : $( this )
          .hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: true,
        selectOnClose: true,
        selectionCssClass: 'select2--small',
        dropdownCssClass: 'select2--small',
      });
    });
  </script>
  @stack('scripts')
</body>

</html>
