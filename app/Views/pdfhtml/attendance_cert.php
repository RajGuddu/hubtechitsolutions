<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Attendance Certificate</title>
</head>

<body>

<div style="width:794px; height:1123px;">

    <!-- Certificate Image -->
    <div>
        <img src="<?= $acimage ?>" style="display:block; width:794px; height:1123px;" alt="">
    </div>

    <!-- Enrollment ID -->
    <div style="margin-top:-850px; margin-left:580px; width:140px; font-size:14px; font-weight:bold; color:#000;">
        <?= $record->cert_no ?? '' ?>
    </div>

    <!-- Student Name -->
    <div style="margin-top:155px; margin-left:76px; width:643px; text-align:center; font-family:'Monotype Corsiva'; font-size:25px; font-weight:bold; color:#000;">
        <?= ucwords($record->stu_name ?? '') ?>
    </div>

    <!-- Course Name -->
    <div style="margin-top:40px; margin-left:76px; width:643px; text-align:center; font-size:18px; font-weight:bold; color:#000;">
        <?= strtoupper($record->ic_name ?? '') ?>
    </div>

    <!-- Attendance -->
    <div style="margin-top:147px; margin-left:76px; width:643px; text-align:center; font-size:45px; font-weight:bold; color:#000;">
        <?= $record->attendence ?? '' ?>%
    </div>

    <!-- Date -->
    <div style="margin-top:135px; margin-left:197px; font-size:16px; font-weight:bold; color:#000;">
        <?= date('d M Y', strtotime($record->completion_date ?? date('Y-m-d'))) ?>
    </div>

</div>

</body>
</html>