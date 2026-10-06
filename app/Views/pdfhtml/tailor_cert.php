<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tailoring Certificate</title>
</head>

<body>

<div style="width:794px; height:1123px;">

    <!-- Certificate Image -->
    <div>
        <img src="<?= $acimage ?>" style="display:block; width:794px; height:1123px;" alt="">
    </div>

    <!-- Enrollment ID -->
    <div style="margin-top:-910px; margin-left:604px; width:140px; font-size:14px; font-weight:bold; color:#000;">
        <?= $record->cert_no ?? '' ?>
    </div>

    <!-- Student Name -->
    <div style="margin-top:160px; margin-left:49px; width:643px; text-align:center; font-family:'Monotype Corsiva'; font-size:20px; font-weight:bold; color:#000;">
        <?= ucwords($record->stu_name ?? '') ?>
    </div>

    <div style="margin-top:17px; margin-left:119px; width:357px; font-size:16px; font-weight:bold; color:#000;">
        <?= ucwords($record->f_name ?? '') ?>
    </div>
    
    <!-- Course Name -->
    <div style="margin-top:20px; margin-left:76px; width:643px; text-align:center; font-size:18px; font-weight:bold; color:#000;">
        <?= strtoupper($record->course_name ?? '') ?>
    </div>

    <div style="margin-top:20px; margin-left:132px; width:78px; text-align:center; font-size:16px; font-weight:bold; color:#000;">
        <?= $record->grade ?? '' ?>
    </div>

    <!-- Date -->
    <div style="margin-top:245px; margin-left:161px; width:133px; font-size:16px; font-weight:bold; color:#000;">
        <?= date('d M Y', strtotime($record->completion_date ?? date('Y-m-d'))) ?>
    </div>
    <!-- image -->
    <div style="margin-top:-75px; margin-left:344px; width:80px; height:90px; border:1px solid #ddd; padding:3px; border-radius:5px; overflow:hidden;">
        <img src="<?= $dpimage ?>" style="width:80px; height:90px; display:block;" alt="">
    </div>
    <!-- QRimage -->
    <div style="margin-top:27px; margin-left:118px; width:133px; font-size:16px; font-weight:bold; color:#000;">
        <img src="<?= $qr_image ?>" style="width:80px; height:90px;" alt="">
    </div>

</div>

</body>
</html>