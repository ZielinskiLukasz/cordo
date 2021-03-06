<?php

declare(strict_types=1);

namespace App\Backoffice\Users\Application\Command;

use System\Application\Queue\AbstractMessage;

class SendUserWelcomeMessage extends AbstractMessage
{
    public string $email;

    public string $locale;
}
