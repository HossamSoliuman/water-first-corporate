<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Accepts an SMTP host only when it is a well-formed public hostname or IP.
 *
 * Unless `mail.dynamic_smtp.allow_private_hosts` is set (local mail catchers
 * only), hosts that are — or resolve to — loopback, private, link-local or
 * reserved addresses are rejected, so the admin panel cannot be used to
 * probe internal network services.
 */
class PublicSmtpHost implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $host = strtolower(trim((string) $value));
        $isIp = filter_var($host, FILTER_VALIDATE_IP) !== false;

        if (! $isIp && (! str_contains($host, '.') || filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) === false)) {
            $fail('The :attribute must be a valid hostname (e.g. smtp.example.com) or IP address.');

            return;
        }

        if (config('mail.dynamic_smtp.allow_private_hosts')) {
            return;
        }

        if (preg_match('/(^|\.)(localhost|local|internal|localdomain|lan|home\.arpa)$/', $host)) {
            $fail('The :attribute must be a public mail server, not an internal host.');

            return;
        }

        $addresses = $isIp ? [$host] : $this->resolve($host);

        if ($addresses === []) {
            $fail('The :attribute could not be resolved. Check the hostname.');

            return;
        }

        foreach ($addresses as $address) {
            if (filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
                $fail('The :attribute points to a private or reserved network address, which is not allowed.');

                return;
            }
        }
    }

    /**
     * @return array<int, string>
     */
    private function resolve(string $host): array
    {
        $ipv4 = gethostbynamel($host) ?: [];
        $ipv6 = array_column(@dns_get_record($host, DNS_AAAA) ?: [], 'ipv6');

        return [...$ipv4, ...$ipv6];
    }
}
