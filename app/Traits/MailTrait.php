<?php

namespace App\Traits;

use Config\Services;

trait MailTrait
{
    /**
     * Send Mail to Admin
     */
    public function mail_to_admin(array $mailConfig = [], array $mailData = [])
    {
        $email = Services::email();

        $subject = $mailConfig['subject'] ?? 'Admin Notification';

        try {

            $message = view('emailer/email_admin_common', $mailData);

            $email->setTo(ADMIN_EMAIL_ID);
            $email->setSubject($subject);
            $email->setMessage($message);

            if ($email->send()) {
                $email->clear(true);
                return true;
            }

            log_message('error', $email->printDebugger(['headers']));
            return false;

        } catch (\Exception $e) {

            log_message('error', 'Admin mail error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send Mail to User
     */
    public function mail_to_user(array $mailConfig = [], array $mailData = [])
    {
        $email = Services::email();

        $subject = $mailConfig['subject'] ?? WEBSITE_NAME . ' Notification';
        $mailTo  = $mailConfig['mailto'] ?? 'test152@yopmail.com';

        try {

            $message = view('emailer/email_user', $mailData);

            $email->setTo($mailTo);
            $email->setSubject($subject);
            $email->setMessage($message);

            $pdfAttachment = $mailConfig['attachment'] ?? null;

            if (!empty($pdfAttachment)) {

                // Raw file content (PDF string)
                if (is_array($pdfAttachment)) {

                    $email->attach(
                        $pdfAttachment['content'],
                        'attachment',
                        $pdfAttachment['filename'],
                        $pdfAttachment['mime'] ?? 'application/pdf'
                    );

                }
            }

            if ($email->send()) {
                $email->clear(true);
                return true;
            }

            log_message('error', $email->printDebugger(['headers']));
            return false;

        } catch (\Exception $e) {

            log_message('error', 'User mail error: ' . $e->getMessage());
            return false;
        }
    }
}