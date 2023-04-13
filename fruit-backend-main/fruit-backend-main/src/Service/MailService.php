<?php

namespace App\Service;

use PhpParser\Node\Expr\Throw_;
use Symfony\Component\Mailer\MailerInterface;

;

use Symfony\Component\Mime\Email;

class MailService
{
    protected MailerInterface $mailer;
    protected string $mailFrom;
    protected string $mailTo;

    public function __construct(
        $mailFrom,
        $mailTo,
        MailerInterface $mailer
    )
    {
        $this->mailer = $mailer;
        $this->mailFrom = $mailFrom;
        $this->mailTo = $mailTo;
    }

    public function sendMail($errorMsg, $duplicateFruits, $successFruits): bool
    {
        try {
            $email = (new Email())
                ->from($this->mailFrom)
                ->to($this->mailTo)
                ->subject('Get List Fruit Command Notification')
                ->html($this->makeContentMail($errorMsg, $duplicateFruits, $successFruits));

            $this->mailer->send($email);
            return true;
        } catch (\Throwable $th) {
            throw new \Exception($th);
        }
    }

    public function makeContentMail($errorMsg, $duplicateFruits, $successFruits): string
    {
        $content = '<h1>Fetch Fruit From ' . $_SERVER['API_FRUIT_URL'] . '</h1><br>';
        if ($errorMsg)
            $content .= '<p>' . $errorMsg . '</p><br>';

        if ($duplicateFruits)
            $content .= '<p>These fruits are exist in database: ' . implode(", ", $duplicateFruits) . '</p><br>';

        if ($successFruits)
            $content .= '<p>These fruits are insert to database successfully: ' . implode(", ", $successFruits) . '</p>';

        return $content;
    }
}