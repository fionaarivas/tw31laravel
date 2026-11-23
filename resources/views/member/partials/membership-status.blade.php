@php
    $membershipStatus = strtolower($status ?? 'pending');

    $membershipBadge = match ($membershipStatus) {
        'active' => 'badge-success',
        'pending' => 'badge-warning',
        'inactive' => 'badge-danger',
        default => '',
    };
@endphp

<span class="badge {{ $membershipBadge }}">{{ ucfirst($membershipStatus) }}</span>
