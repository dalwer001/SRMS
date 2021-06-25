<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{-- @dd($issueMsg); --}}
    {{-- <p>Machine {{ $notifyMsg ->status }}</p> --}}

<p>Dear Sales Manager,</p><br>
<p>This mail is to notify you that {{$commission->task->employee->employeeDetail->name }}, completed his task and his email is {{ $commission->task->employee->employeeDetail->email }}.</p>
<p>His commission amount is {{ $commission->commission }} BDT.</p>
<br>
<p>Sincerely,</p>
<br>
<p>Amulet Pharmacitical Ltd,</p>
<p>House # 04 (2rd Floor), Mohakhali C/A, Dhaka-1212, Bangladesh.</p>
<p>Tel : +02 989 42 92.</p>


</body>

</html>
