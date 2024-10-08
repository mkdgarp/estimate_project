<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MultiFile Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-multifile/1.0.0/jquery.multifile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-multifile/1.0.0/jquery.multifile.min.js"></script>
    <script src="{{asset('jquery.MultiFile.js')}}"></script>
</head>

<body>

    <input type="file" class="multifile" name="files[]" multiple />
    <button id="addFile">Add File</button>

    <script>
        $(document).ready(function() {
            $('.multifile').MultiFile({
                // your options go here
                max: 2,
                accept: 'jpg|png|gif'
            });

            $('#addFile').click(function() {
                var newInput = $('<input type="file" class="multifile" name="files[]" multiple />');
                newInput.appendTo('body');
                newInput.multifile();
            });
        });
    </script>

</body>

</html>
