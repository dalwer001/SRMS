<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail from Admin</title>
</head>

<body>
    {{-- @dd($issueMsg); --}}
    {{-- <p>Machine {{ $notifyMsg ->status }}</p> --}}

<p>Dear Sales Manager,</p><br>
<p>This mail is to notify you that {{$task->employee->employeeDetail->name}}, did not complete his task between {{$task->start_date}} to {{$task->end_date}} and his email is {{ $task->employee->employeeDetail->email }}.</p>
<p>The remaining task product quantity is {{ $task->target_quantity }} which have been returned to the stock.</p>
<br>
<p>Sincerely,</p>
<br>
<p>SRMS Ltd,</p>
<p>House # 04 (2rd Floor), Mohakhali C/A, Dhaka-1212, Bangladesh.</p>
<p>Tel : +02 989 42 92.</p>


</body>

</html>
