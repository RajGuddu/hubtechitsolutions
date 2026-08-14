<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Internship Certificate</title>
</head>

<body>

<div style="width:794px; height:1123px;">

    <!-- Certificate Image -->
    <div>
        <img src="<?= $acimage ?>" style="display:block; width:794px; height:1123px;" alt="">
    </div>

    <!-- Enrollment ID -->
    <div style="margin-top:-928px; margin-left:604px; width:140px; font-size:14px; font-weight:bold; color:#000;">
        <?= $record->cert_no ?? '' ?>
    </div>

    <!-- Student Name -->
    <div style="margin-top:146px; margin-left:76px; width:643px; text-align:center; font-family:'Monotype Corsiva'; font-size:20px; font-weight:bold; color:#000;">
        <?= ucwords($record->stu_name ?? '') ?>
    </div>

    <!-- Reg. No & class-->
    <div style="margin-top:25px; margin-left:190px; width:174px; font-size:16px; font-weight:bold; color:#000;">
        <?= $record->uni_reg_no ?? '' ?>
    </div>
    <div style="margin-top:-20px; margin-left:477px; width:239px; font-size:16px; font-weight:bold; color:#000;">
        <?= $record->class ?? '' ?> (<?=ucwords(esc($record->sub_name ?? ''))?>)
    </div>
    <div style="margin-top:18px; margin-left:105px; width:620px; text-align:center; font-size:16px; font-weight:bold; color:#000;">
        <?= ucwords($record->college_name ?? '') ?>
    </div>
    
    <!-- Course Name -->
    <div style="margin-top:55px; margin-left:76px; width:643px; text-align:center; font-size:18px; font-weight:bold; color:#000;">
        <?= strtoupper($record->ic_name ?? '') ?>
    </div>

    <!-- Attendance -->
    <div style="margin-top:142px; margin-left:222px; width:78px; text-align:center; font-size:16px; font-weight:bold; color:#000;">
        <?= $record->attendence ?? '' ?>%
    </div>
    <div style="margin-top:-22px; margin-left:503px; width:96px; text-align:center; font-size:16px; font-weight:bold; color:#000;">
        120 Hrs.
    </div>
    <div style="margin-top:15px; margin-left:177px; width:78px; text-align:center; font-size:16px; font-weight:bold; color:#000;">
        <?= $record->grade ?? '' ?>
    </div>

    <!-- Date -->
    <div style="margin-top:75px; margin-left:144px; width:133px; font-size:16px; font-weight:bold; color:#000;">
        <?= date('d M Y', strtotime($record->completion_date ?? date('Y-m-d'))) ?>
    </div>
    <!-- image -->
    <div style="margin-top:-75px; margin-left:344px; width:80px; height:90px; border:1px solid #ddd; padding:3px; border-radius:5px; overflow:hidden;">
        <img src="<?= $dpimage ?>" style="width:80px; height:90px; display:block;" alt="">
    </div>
    <!-- QRimage -->
    <div style="margin-top:38px; margin-left:80px; width:133px; font-size:16px; font-weight:bold; color:#000;">
        <img src="<?= $qr_image ?>" style="width:80px; height:90px;" alt="">
    </div>

</div>

</body>
</html>