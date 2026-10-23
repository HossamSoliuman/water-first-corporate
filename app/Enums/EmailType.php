<?php

namespace App\Enums;

enum EmailType: string
{
    case AdminNotification = 'admin_notification';
    case CustomerAcknowledgement = 'customer_acknowledgement';
    case Test = 'test';

    public function label(): string
    {
        return match ($this) {
            self::AdminNotification => 'Admin notification',
            self::CustomerAcknowledgement => 'Customer auto-reply',
            self::Test => 'Test email',
        };
    }

    /**
     * Types that have an admin-editable template.
     *
     * @return array<int, self>
     */
    public static function templated(): array
    {
        return [self::AdminNotification, self::CustomerAcknowledgement];
    }
}
