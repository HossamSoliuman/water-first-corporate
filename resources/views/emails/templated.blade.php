{{-- emails/templated.blade.php — shell for admin-editable emails. All $email fragments are pre-sanitised by EmailTemplateRenderer. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>{{ $email->subject }}</title>
</head>
<body style="margin:0;padding:0;background:#F5FBFE;font-family:Arial,Helvetica,sans-serif;color:#12324A;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F5FBFE;padding:24px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background:#FFFFFF;border-top:4px solid #07579A;">
                @if($email->headingHtml !== '')
                <tr>
                    <td style="padding:28px 32px 8px;">
                        <h1 style="margin:0;font-size:22px;line-height:1.3;color:#07579A;font-weight:700;">{!! $email->headingHtml !!}</h1>
                        <div style="width:48px;height:3px;background:#00A6A6;margin-top:12px;"></div>
                    </td>
                </tr>
                @endif
                <tr>
                    <td style="padding:16px 32px 8px;font-size:15px;line-height:1.6;color:#12324A;">
                        {!! $email->bodyHtml !!}
                    </td>
                </tr>
                @if($email->buttonText && $email->buttonUrl)
                <tr>
                    <td style="padding:8px 32px 24px;">
                        <a href="{{ $email->buttonUrl }}" style="display:inline-block;background:#07579A;color:#FFFFFF;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:2px;">{{ $email->buttonText }}</a>
                    </td>
                </tr>
                @endif
                @if($email->companyDetailsHtml !== '')
                <tr>
                    <td style="padding:16px 32px;border-top:1px solid #E2EEF5;font-size:13px;line-height:1.6;color:#12324A;">
                        {!! $email->companyDetailsHtml !!}
                    </td>
                </tr>
                @endif
                @if($email->footerHtml !== '')
                <tr>
                    <td style="padding:16px 32px 24px;background:#F5FBFE;font-size:12px;line-height:1.5;color:#5B7487;">
                        {!! $email->footerHtml !!}
                    </td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>
</body>
</html>
