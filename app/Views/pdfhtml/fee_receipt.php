<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            background: #f5f6f8;
            font-family: Arial, Helvetica, sans-serif;
            color: #212529;
            font-size: 13px;
        }

        .receipt {
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            overflow: hidden;
        }

        /* Header */
        .receipt-header {
            padding: 22px 25px;
            border-bottom: 1px solid #e9ecef;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-left {
            width: 60%;
            vertical-align: middle;
        }

        .header-right {
            width: 40%;
            text-align: right;
            vertical-align: middle;
        }

        .company-name {
            font-size: 22px;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 4px;
        }

        .company-subtitle {
            font-size: 11px;
            color: #6c757d;
        }

        .receipt-title {
            font-size: 19px;
            font-weight: 700;
            color: #343a40;
        }

        .receipt-subtitle {
            font-size: 11px;
            color: #6c757d;
            margin-top: 4px;
        }

        /* Success */
        .success-box {
            margin: 20px 25px;
            padding: 12px 15px;
            background: #eaf7ef;
            border: 1px solid #ccebd7;
            border-radius: 8px;
            color: #198754;
        }

        .success-title {
            font-size: 13px;
            font-weight: 700;
        }

        .success-text {
            margin-top: 4px;
            font-size: 11px;
            color: #4f6f5d;
        }

        /* Student */
        .section {
            margin: 0 25px 20px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            width: 50%;
            padding: 0 5px;
        }

        .info-table td:first-child {
            padding-left: 0;
        }

        .info-table td:last-child {
            padding-right: 0;
        }

        .info-box {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 12px;
        }

        .label {
            font-size: 10px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .value {
            font-size: 13px;
            font-weight: 700;
        }

        .registration-no {
            color: #0d6efd;
        }

        /* Course */
        .course-box {
            margin: 0 25px 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .course-heading {
            padding: 10px 14px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-size: 12px;
            font-weight: 700;
        }

        .course-body {
            padding: 14px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table td {
            padding: 7px 0;
        }

        .detail-label {
            color: #6c757d;
            font-size: 11px;
        }

        .detail-value {
            text-align: right;
            font-size: 12px;
            font-weight: 700;
        }

        /* Payment */
        .payment-box {
            margin: 0 25px 20px;
            padding: 14px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .payment-heading {
            font-size: 11px;
            color: #6c757d;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-table td {
            width: 50%;
            vertical-align: top;
        }

        .payment-label {
            font-size: 9px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .payment-value {
            font-size: 11px;
            font-weight: 700;
            word-break: break-all;
        }

        /* Amount */
        .amount-box {
            margin: 0 25px 20px;
            padding: 15px 18px;
            background: #f1f6ff;
            border: 1px solid #d8e7ff;
            border-radius: 8px;
        }

        .amount-table {
            width: 100%;
            border-collapse: collapse;
        }

        .amount-label {
            font-size: 13px;
            font-weight: 700;
        }

        .amount {
            text-align: right;
            font-size: 21px;
            font-weight: 700;
            color: #0d6efd;
        }

        /* Footer */
        .receipt-footer {
            padding: 15px 25px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .footer-text {
            font-size: 10px;
            color: #6c757d;
        }

        .footer-subtext {
            font-size: 9px;
            color: #6c757d;
            margin-top: 4px;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <!-- Header -->
        <div class="receipt-header">
            <table class="header-table">
                <tr>
                    <td class="header-left">
                        <table style="border-collapse:collapse;">
                            <tr>
                                <!-- Logo -->
                                <td style="vertical-align:middle; padding-right:10px;">
                                    <img src="<?= base_url('public/assets/images/logo/logo-dark.png') ?>" style="width:55px; height:auto;max-height:55px;" alt="Logo">
                                </td>
                                <!-- Company Name -->
                                <td style="vertical-align:middle;">
                                    <div class="company-name">
                                        <?= WEBSITE_NAME ?>
                                    </div>
                                    <div class="company-subtitle">
                                        Vocational Education & Training
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="header-right">
                        <div class="receipt-title">
                            PAYMENT RECEIPT
                        </div>
                        <div class="receipt-subtitle">
                            Examination Fee
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Payment Successful -->
        <div class="success-box">
            <div class="success-title">
                ✓ Payment Successful
            </div>
            <div class="success-text">
                Your examination fee has been received successfully.
            </div>
        </div>
        <!-- Student Information -->
        <div class="section">
            <table class="info-table">
                <tr>
                    <td>
                        <div class="info-box">
                            <div class="label">
                                Student Name
                            </div>
                            <div class="value">
                                <?=ucwords($record->stu_name)?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="info-box">
                            <div class="label">
                                Registration No.
                            </div>
                            <div class="value registration-no">
                                <?=$record->reg_no?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Course Details -->
        <?php $courseDtls = json_decode($record->course_details); ?>
        <div class="course-box">
            <div class="course-heading">
                Course Details
            </div>
            <div class="course-body">
                <table class="detail-table">
                    <tr>
                        <td class="detail-label">
                            Course
                        </td>
                        <td class="detail-value">
                            <?=ucwords($courseDtls->course_name).' ('.$courseDtls->course_short_name.')'?>
                        </td>
                    </tr>
                    <tr>
                        <td class="detail-label">
                            Examination Fee
                        </td>
                        <td class="detail-value">
                            ₹<?=$courseDtls->exam_fee?>
                        </td>
                    </tr>
                    <tr>
                        <td class="detail-label">
                            Payment Date
                        </td>
                        <td class="detail-value">
                            <?=date('d-M-Y',strtotime($record->added_at))?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Payment Information -->
        <div class="payment-box">
            <div class="payment-heading">
                Payment Information
            </div>
            <table class="payment-table">
                <tr>
                    <td>
                        <div class="payment-label">
                            Payment ID
                        </div>
                        <div class="payment-value">
                            <?=$record->exam_payment_id?>
                        </div>
                    </td>
                    <td>
                        <div class="payment-label">
                            Order ID
                        </div>
                        <div class="payment-value">
                            <?=$record->exam_order_id?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Total Paid -->
        <div class="amount-box">
            <table class="amount-table">
                <tr>
                    <td class="amount-label">
                        Total Paid
                    </td>
                    <td class="amount">
                        ₹<?=$courseDtls->exam_fee?>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Footer -->
        <div class="receipt-footer">
            <div class="footer-text">
                This is a computer-generated payment receipt.
            </div>
            <div class="footer-subtext">
                Thank you for choosing <?=WEBSITE_NAME?>.
            </div>
        </div>
    </div>
</body>

</html>