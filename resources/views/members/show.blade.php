<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Member Profile</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            width: 92%;
            max-width: 750px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #1f3c88;
        }

        .row {
            padding: 13px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .label {
            font-weight: bold;
            color: #64748b;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 17px;
            background: #1f3c88;
            color: white;
            border-radius: 7px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1>Member Profile</h1>

        <div class="row">
            <div class="label">Membership Number</div>
            {{ $member->membership_number }}
        </div>

        <div class="row">
            <div class="label">Name</div>
            {{ $member->name }}
        </div>

        <div class="row">
            <div class="label">Email</div>
            {{ $member->email }}
        </div>

        <div class="row">
            <div class="label">Phone Number</div>
            {{ $member->phone_number }}
        </div>

        <div class="row">
            <div class="label">Address</div>
            {{ $member->address }}
        </div>

        <div class="row">
            <div class="label">Category</div>
            {{ $member->membershipCategory?->name ?? 'N/A' }}
        </div>

        <div class="row">
            <div class="label">Level</div>
            {{ $member->membershipLevel?->name ?? 'N/A' }}
        </div>

        <div class="row">
            <div class="label">Status</div>
            {{ ucfirst($member->status) }}
        </div>

        <a href="{{ route('members.index') }}">
            Back to Members
        </a>
    </div>
</div>

</body>
</html>