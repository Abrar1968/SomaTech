<x-mail::message>
# 🔔 New Contact Inquiry Received

A potential client has submitted an inquiry through your website.

---

## Contact Information

<x-mail::table>
| Field | Details |
|:------|:--------|
| **Name** | {{ $inquiry->name }} |
| **Email** | {{ $inquiry->email }} |
@if($inquiry->phone)
| **Phone** | {{ $inquiry->phone }} |
@endif
@if($inquiry->company)
| **Company** | {{ $inquiry->company }} |
@endif
</x-mail::table>

---

## Inquiry Details

<x-mail::table>
| Field | Details |
|:------|:--------|
| **Service Interest** | {{ $inquiry->service_interest }} |
@if($inquiry->budget_range)
| **Budget Range** | {{ $inquiry->budget_range }} |
@endif
| **Submitted** | {{ $inquiry->created_at->format('F j, Y \a\t g:i A') }} |
</x-mail::table>

---

## Message

<x-mail::panel>
{{ $inquiry->message }}
</x-mail::panel>

---

<x-mail::button :url="config('app.url') . '/admin/inquiries/' . $inquiry->id" color="primary">
View Full Details in Dashboard
</x-mail::button>

@if($inquiry->ip_address)
<x-mail::subcopy>
**Technical Info:** Submitted from IP {{ $inquiry->ip_address }}
</x-mail::subcopy>
@endif

Thanks,<br>
**{{ config('app.name') }} System**
</x-mail::message>
