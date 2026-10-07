<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loader</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

   <div id="loader" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <img src="<?php echo base_url('images/Loading_2.gif'); ?>" style="position: relative;
    top: 0;
    width: 200px;" alt="Loading...">
</div>

    <div id="content" style="display:none;">
        
    </div>

    <script>
        $(document).ready(function() {
            // Show the loader for 20 seconds
            setTimeout(function() {
                $('#loader').fadeOut(500, function() {
                    $('#content').fadeIn(500);
                });
            }, 20000); // 20000 ms = 20 seconds
        });
    </script>

</body>
</html>