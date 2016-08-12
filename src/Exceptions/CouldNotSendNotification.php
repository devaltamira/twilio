<?php

namespace NotificationChannels\Twilio\Exceptions;

use NotificationChannels\Twilio\CallMessage;
use NotificationChannels\Twilio\SmsMessage;

class CouldNotSendNotification extends \Exception
{
    /**
     * @param \Exception $exception
     *
     * @return static
     */
    public static function serviceRespondedWithAnException($exception)
    {
        return new static("Notification was not sent. Twilio responded with `{$exception->getCode()}: {$exception->getMessage()}`");
    }

    /**
     * @param mixed $message
     *
     * @return static
     */
    public static function invalidMessageObject($message)
    {
        $className = get_class($message) ?: 'Unknown';

        return new static("Notification was not sent. Message object class `{$className}` is invalid. It should be either `".SmsMessage::class.'` or `'.CallMessage::class.'`');
    }

    /**
     * @return static
     */
    public static function missingFrom()
    {
        return new static('Notification was not sent. Missing `from` number.');
    }
}
