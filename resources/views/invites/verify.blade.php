<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Verify Invite</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&amp;display=swap"
          rel="stylesheet">
    <style>
        body {
            color: #222222;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

<script>
    swal({
        title: @js($invite->name),
        text: "Passes: {{ $invite->passes }}",
        icon: "success",
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: false,
    });
</script>

</body>
</html>
