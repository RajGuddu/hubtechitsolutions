<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Internship Offer Letter</title>
</head>
<body style="margin:0;padding:20px;font-family:Calibri,Arial,sans-serif;font-size:13px;color:#333333;">

<div style="width:100%;border:1px solid #999999;padding:25px;box-sizing:border-box;">

    <!-- Header -->
    <table style="width:100%;border-collapse:collapse;">
        <tr>
            <td style="width:20%;">
                <img src="https://hubtechitsolutions.in/public/assets/images/logo/logo-dark.png" style="height:70px;">
            </td>

            <td style="width:80%;text-align:right;line-height:20px;font-size:12px;">
                <strong style="font-size:18px;">Hub Techsolutions</strong><br>
                (A Unit of Swami Educational Society)<br>
                Reg. No.: 2372/11<br>
                Maharaja Hata, Katira Road, Arrah - 802301, Bihar<br>
                info@hubtechitsolutions.in | +91 93866 93039<br>
                www.hubtechitsolutions.in
            </td>
        </tr>
    </table>

    <!-- Title -->
    <div style="text-align:center;margin-top:16px;margin-bottom:16px;">
        <span style="font-size:20px;font-weight:bold;">
            INTERNSHIP OFFER LETTER
        </span>
        <!-- for underline -->
        <div style="width:280px;height:2px;background:#333;margin:0px auto 0 auto;"></div>
    </div>

    <!-- Ref No -->
    <table style="width:100%;margin-bottom:20px;">
        <tr>
            <td>
                <strong>Letter Ref. No.:</strong>
                HTS/SES/<?=$student->enroll_id?>
            </td>

            <td style="text-align:right;">
                <strong>Date:</strong>
                <?=date('d M Y',strtotime($student->added_at)) ?>
            </td>
        </tr>
    </table>

    <!-- Candidate Details -->
    <div style="line-height:22px;margin-bottom:15px;">
        To,<br><br>

        <strong><?=ucwords($student->stu_name)?></strong><br>
        Registration No.: <?=$student->enroll_id?><br>
        <?=ucwords(strtolower($student->college_name))?>
    </div>

    <p style="line-height:22px;">
        Dear Candidate,
    </p>

    <p style="text-align:justify;line-height:20px;margin:6px 0">
        We are pleased to inform you that your application for the
        <strong><?=ucwords($student->ic_name)?> Internship Programme</strong> at
        <strong>Hub Techsolutions</strong> has been accepted.
    </p>

    <p style="text-align:justify;line-height:20px;margin:6px 0">
        You have been enrolled in our online internship portal and provided
        access to a dedicated dashboard for your internship activities.
        Through this dashboard, you will be able to access study materials,
        learning resources, internship guidelines, assessments, and other
        programme-related information.
    </p>

    <!-- Internship Details -->
    <table style="width:100%;border-collapse:collapse;margin-top:15px;margin-bottom:15px;">

        <tr>
            <td style="width:35%;padding:4px 0;">
                <strong>Name of Student</strong>
            </td>
            <td>: <?=ucwords($student->stu_name)?></td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Registration Number</strong>
            </td>
            <td>: <?=$student->enroll_id?></td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>College / Institution</strong>
            </td>
            <td>: <?=ucwords(strtolower($student->college_name))?></td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Department / Semester</strong>
            </td>
            <td>: <?=$student->class?> - 5th Semester</td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Internship Domain</strong>
            </td>
            <td>: <?=ucwords($student->ic_name)?></td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Internship Duration</strong>
            </td>
            <td>: <?=$student->duration?> Hours</td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Portal URL</strong>
            </td>
            <td>: https://hubtechitsolutions.in</td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Username</strong>
            </td>
            <td>: <?=$student->email?></td>
        </tr>

        <tr>
            <td style="padding:4px 0;">
                <strong>Password</strong>
            </td>
            <td>: 123456</td>
        </tr>

    </table>

    <p style="text-align:justify;line-height:20px;margin:6px 0">
        Please keep your login credentials secure and confidential. After
        completing the prescribed study materials, you will be required to
        appear for an online assessment through the internship portal.
    </p>

    <p style="text-align:justify;line-height:20px;margin:6px 0">
        Upon successful completion of the programme and assessment, you will
        be eligible to download your Internship Completion Certificate directly
        from your dashboard. The entire process, including learning, assessment,
        and certificate generation, is conducted online through the portal.
    </p>

    <p style="text-align:justify;line-height:20px;margin:6px 0">
        We wish you a successful and enriching internship experience and look
        forward to your active participation throughout the programme.
    </p>

    <!-- Signature Section -->
    <table style="width:100%;margin-top:30px;">
        <tr>

            <td style="width:55%;"></td>

            <td style="width:45%;text-align:center;">

                <img src="<?=base_url('public/assets/images/logo/stamp.png')?>"
                     style="height:70px;max-width:220px;">

                <br>

                <strong>Authorized Signatory</strong><br>
                Hub Techsolutions<br>
                <span style="font-size:12px;">
                    (A Unit of Swami Educational Society)
                </span>

            </td>

        </tr>
    </table>

</div>

</body>
</html>