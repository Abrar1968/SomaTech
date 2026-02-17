<x-mail::message>
# New Contact Inquiry

You have received a new contact inquiry from your website.

**Name:** {{ $inquiry->name }}
**Email:** {{ $inquiry->email }}
@if($inquiry->phone)
**Phone:** {{ $inquiry->phone }}
@endif
@if($inquiry->company)
**Company:** {{ $inquiry->company }}
@endif
**Service Interest:** {{ $inquiry->service_interest }}
@if($inquiry->budget_range)
**Budget Range:** {{ $inquiry->budget_range }}
@endif

## Message

{{ $inquiry->message }}

---

**Submitted:** {{ $inquiry->created_at->format('F j, Y \a\t g:i A') }}
**IP Address:** {{ $inquiry->ip_address }}

<x-mail::button :url="config('app.url') . '/admin/inquiries/' . $inquiry->id">
View in Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
