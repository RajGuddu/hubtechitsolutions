<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Festival Certificate</title>
</head>

<body>

<div style="width:1150px; height:850px;">

    <!-- Certificate Image -->
    <div>
        <img src="<?= $acimage ?>" style="display:block; width:1150px; height:850px;" alt="">
    </div>
    <!-- Festival Title -->
    <div style="margin-top:-397px; margin-left:61px; width:1029px; text-align:center; font-family:'khand';letter-spacing: 2px; font-size:30px; font-weight:bold; color:#0c2778;">
        <?php echo $record->cert_title ?? '' ?>
    </div>

    <div style="margin-top:-6px; margin-left:610px; width:140px; font-size:12px; font-weight:bold; color:#000;">
        <?= $record->fes_cert_no ?? '' ?>
    </div>

    <div style="margin-top:2px; margin-left:310px; width:344px; font-size:18px; font-weight:bold; color:#80082b;">
        <?= ucwords($record->name ?? '') ?>
    </div>
    <div style="margin-top:-27px; margin-left:39px; width:135px; height:215px; border:3px solid #b8860b; border-radius:8px; padding:0px; overflow:hidden;">
        <img src="<?= $dpimage ?>" style="width:134px; height:214px;  border-radius:8px; display:block;" alt="">
    </div>
    
    <div style="margin-top:-188px; margin-left:135px; width:445px; text-align:center; font-size:16px; font-weight:bold; color:#0c2778;">
        <?= strtoupper($record->festival_title ?? '') ?>
    </div>

    <div style="margin-top:35px; margin-left:150px; width:795px; text-align:center; font-family:'free-sans';font-size:20px; font-weight:bold; color:#80082b; letter-spacing: 3px;">
        <?= strtoupper('Hubtech computer center')?>
    </div>
    

</div>

</body>
</html>