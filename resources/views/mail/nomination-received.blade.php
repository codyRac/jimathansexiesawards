<x-mail::message>
@if ($forAdmin)
# New Nomination Received

A new Xies nomination is awaiting payment verification.
@else
# Your Nomination Was Received

Thank you for nominating **{{ $nomination->nominee_name }}** for the Jim Athans Xies Awards — the X Impact Awards.
@endif

**Nomination number:** {{ $nomination->nomination_number }}

**Nominee:** {{ $nomination->nominee_name }} ({{ '@'.$nomination->nominee_x_handle }})

@if ($nomination->show_name)
**Show / Space:** {{ $nomination->show_name }}
@endif

**Categories:** {{ implode(', ', $nomination->categories) }}

**Amount due:** ${{ $nomination->amount_due }}

@if ($nomination->payment_reference)
**Payment reference:** {{ $nomination->payment_reference }}
@endif

@if ($forAdmin)
Submitted by {{ $nomination->nominator_name }} ({{ $nomination->nominator_email }}). Review it on the dashboard and mark it verified once payment is confirmed.
@else
Your entry becomes official once your ${{ $nomination->amount_due }} nomination fee is verified. Keep your nomination number for your records — you'll need it for any questions about your entry.

Questions? Call us at {{ implode(' or ', config('xies.phones')) }}.
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
