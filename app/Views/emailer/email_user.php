<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9f9f9; margin:0; padding:0;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#fff;border-radius:8px;border:1px solid #e0e0e0;overflow:hidden;">

                <!-- Logo -->
                <tr>
                    <td align="center" style="padding:20px;">
                        <img src="<?= base_url('public/assets/images/logo/logo-dark.png') ?>"
                             alt="<?= esc(WEBSITE_NAME) ?>"
                             style="max-width:120px;">
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding:30px;">

                        <h2 style="color:#333;margin-top:0;">
                            <?= esc($heading ?? ('Hello from ' . WEBSITE_NAME)) ?>
                        </h2>

                        <p style="color:#555;font-size:15px;">
                            Dear <?= esc($name ?? 'User') ?>,
                        </p>

                        <div style="color:#555;font-size:14px;">
                            <?= $content ?? '' ?>
                        </div>

                        <?php if (!empty($details) && is_array($details)): ?>
                            <table width="100%" cellpadding="6" cellspacing="0"
                                   style="border-collapse:collapse;margin-top:20px;">
                                <?php foreach ($details as $label => $value): ?>
                                    <tr>
                                        <td style="border:1px solid #ddd;">
                                            <strong><?= esc($label) ?></strong>
                                        </td>
                                        <td style="border:1px solid #ddd;">
                                            <?= esc($value) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>

                        <p style="margin-top:25px;font-size:14px;">
                            Thanks &amp; Regards,<br>
                            <strong><?= esc(WEBSITE_NAME) ?> Team</strong>
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f1f1f1;padding:15px;text-align:center;font-size:12px;color:#777;">
                        <strong>Reach us at:</strong><br>
                        <?= esc(REACH_US_EMAIL) ?><br>
                        © <?= date('Y') ?> <?= esc(WEBSITE_NAME) ?>. All rights reserved.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>