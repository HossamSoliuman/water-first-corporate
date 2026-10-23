<?php

namespace App\Services\Mail;

use RuntimeException;

/**
 * Raised when the mail transport rejects a message. The message text has
 * already been sanitised by {@see DynamicMailer::sanitize()}, so it is safe
 * to log and to show to administrators.
 */
class EmailDeliveryFailed extends RuntimeException {}
