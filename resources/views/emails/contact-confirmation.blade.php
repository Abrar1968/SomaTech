<x-mail::message>
# Hello {{ $inquiry->name }}! 👋

Thank you for reaching out to us. We're excited to learn about your project!

Our team has received your inquiry and will review it carefully. You can expect a personalized response within **24 hours** during business days.

---

## Here's What You Shared

<x-mail::panel>
**Service of Interest**
{{ $inquiry->service_interest }}

@if($inquiry->budget_range)
**Budget Range**
{{ $inquiry->budget_range }}
@endif

**Your Message**
{{ Str::limit($inquiry->message, 300) }}
</x-mail::panel>

---

## What Happens Next?

1. **Review** - Our team will carefully review your requirements
2. **Research** - We'll prepare relevant suggestions for your project
3. **Connect** - A team member will reach out with next steps

If you have additional information to share or questions in the meantime, simply reply to this email.

<x-mail::button :url="config('app.url')" color="primary">
Explore Our Work
</x-mail::button>

---

We're looking forward to potentially working together!

Warm regards,<br>
**The {{ config('app.name') }} Team**

<x-mail::subcopy>
This is an automated confirmation email. If you didn't submit this inquiry, please disregard this message.
</x-mail::subcopy>
</x-mail::message>
