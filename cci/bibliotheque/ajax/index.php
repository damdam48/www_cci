<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=" https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js "></script>

    <title>Document</title>
</head>

<body>


    <input type="text" name="" id="name" class="form-control w-25 mx-auto ajaxUpdate" placeholder="Name">
    <input type="text" name="" id="first_name" class="form-control w-25 mx-auto ajaxUpdate" placeholder="firstname">
    <input type="" id="id" value="1">
    <input type="" id="table" value="users">



    <script>
        value = 'My Value';

        $(document).ready(function() {
            // alert()

            $('.ajaxUpdate').blur(function() {
                // console.log('ok, blur')
                value = $(this).val()
                col = $(this).attr('id')
                id = $('#id').val()
                table = $('#table').val()

                // console.log(' value is ' + value)
                ajaxUpdate(value, col, id, table)

            }) // ajaxUpdate'

            // $('#first_name').blur(function() {
            //     // console.log('ok, blur')
            //     value = $(this).val()
            //     col = $(this).attr('id')
            //     // console.log(' value is ' + value)
            //     ajaxUpdate(value, col)

            // }) // end first_name

            function ajaxUpdate(value, col, id, table) {
                // console.log('function ajaxUdate')
                // console.log('value is ' + value)

                $.ajax({
                        method: "POST",
                        url: "ajax.php",
                        data: {value:value, col:col, id:id, table:table},
                        success: function(results) {
                            console.log('AJAX success ' + results);

                        }
                    })
                    .done(function(results) {
                        // console.log('AJAX done ' + results);
                    })

            }

        }) // end $document

        // $.ajax({
        //     method: "POST",
        //     url: "ajax.php",
        //     data: {valuePost: value},
        //         success: function ( results ) {
        //             console.log( 'AJAX success ' + results ); 
        //         }
        //     })
        //     .done(function( results ) {
        //        // console.log('AJAX done ' + results);
        //     })
    </script>





</body>

</html>