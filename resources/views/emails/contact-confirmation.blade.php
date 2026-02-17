<x-mail::message>
# Thank You, {{ $inquiry->name }}!

We have received your inquiry and our team will get back to you within **24 hours**.

## Your Message Summary

**Service Interest:** {{ $inquiry->service_interest }}
@if($inquiry->budget_range)
**Budget Range:** {{ $inquiry->budget_range }}
@endif

> {{ Str::limit($inquiry->message, 200) }}

If you have any additional information to share, feel free to reply to this email.

<x-mail::button :url="config('app.url')">
Visit Somaticx
</x-mail::button>

Best regards,<br>
The {{ config('app.name') }} Team
</x-mail::message>
