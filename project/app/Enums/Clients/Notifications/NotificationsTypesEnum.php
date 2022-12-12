<?php
namespace App\Enums\Clients\Notifications;

class NotificationsTypesEnum
{
    public const EMAIL = 'email';

    public const SMS = 'sms';
    
    public static function getList() : array {
        return [
            self::EMAIL => self::EMAIL,
            self::SMS => self::SMS
        ];
    }
    
    /**
     * Has type of channel or not.
     * @param string $channel
     * @return bool
     */
    public static function hasChannelType(string $channel) : bool {
        $list = self::getList();
        return !empty($list[$channel]);
    }
}
