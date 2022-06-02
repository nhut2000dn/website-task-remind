<!-- <?php 
    include("../../Server-API/LoginControllers.php");
    $startDay = date("Y-m-d h:i:sa");
    $endDay = "2019-10-09 04:24:25";

    function calculate($startDay, $endDay) {
        $nameDate = '';
        $diff = abs(strtotime($startDay) - strtotime($endDay));
    
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    
        if ($years != 0) {
            $nameDate.= $years . ' years';
        }
        if ($years != 0 && $months != 0) {
            $nameDate.= ', ';
        }
        if ($months != 0) {
            $nameDate.= $months . ' months';
        }
        if ($months != 0 && $days != 0) {
            $nameDate.= ', ';
        }
        if ($days != 0) {
            $nameDate.= ' ' . $days . ' Days';
        }

        echo $nameDate;

        // if ($months != 0) {
        //     $dateObj   = DateTime::createFromFormat('!m', $months);
        //     $monthName = $dateObj->format('F'); // March
        //     $nameDate.= ' ' . $monthName;
        // }
    }
    echo "</br>";
    calculate($startDay, $endDay);
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="js/jquery.datetimepicker.js"></script>
    <script>
        var d = new Date($.now());
        alert(d.getDate()+"-"+(d.getMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
        function showDays(firstDate,secondDate){
                        
            var startDay = new Date(firstDate);
            var endDay = new Date(secondDate);
            var millisecondsPerDay = 1000 * 60 * 60 * 24;

            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = millisBetween / millisecondsPerDay;

            // Round down.
            alert( Math.floor(days));

        }
        
        showDays('2019-12-30 04:24:25' ,'2019-9-04 04:24:25');
    </script>
</head>
<body>
    
</body>
</html>