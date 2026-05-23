<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milo Marathon</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #eaf5ea;
            padding: 25px;
            color: #1b4332;
        }
        a.btn{
    text-decoration:none;
        }

        .container {
            max-width: 1400px;
            margin: auto;
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 32px;
            color:#6B3E2E
        }

        .subtitle {
            font-size: 14px;
            color: #5f6f65;
            margin-top: 5px;
        }

        /* SEARCH */
        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-form input {
            width: 280px;
            padding: 11px;
            border: 2px solid #a5d6a7;
            border-radius: 8px;
            outline: none;
        }

        .search-form input:focus {
            border-color: #2e7d32;
        }

        .search-form button {
            padding: 11px 16px;
            border: none;
            background: #2e7d32;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-form button:hover {
            background: #1b5e20;
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
            margin-top: 15px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        thead {
            background: #2e7d32;
            color: white;
        }

        th {
            padding: 14px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 13px;
        }

        tbody tr:hover {
            background: #f1f8f1;
        }

        /* BADGE */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            background: #c8e6c9;
            color: #1b5e20;
            font-size: 12px;
            font-weight: bold;
        }

        /* ACTIONS */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            border: none;
            padding: 7px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
        }

        .edit {
            background: #2e7d32;
            color: white;
        }

        .delete {
            background: #c62828;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-form input {
                width: 100%;
            }

            .search-form button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Milo Marathon</h1>
            <div class="subtitle">Registration Management System</div>
        </div>
        <!--Success Message-->
        @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-top: 10px;">
            {{ session('success') }}
        </div>
        @endif

        <form class="search-form" action="{{ route('partials.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search participants..." required>
            <button type="submit">Search</button>
        </form>
    </div>

    <!--add runner-->

    <div style="margin-bottom: 20px;">
        <a href="{{ route('partials.create') }}" class="btn edit">Add New Runner</a>
    </div>

    <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Emergency Name</th>
                    <th>Emergency Phone</th>
                    <th>Level</th>
                    <th>Shirt</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($registrations as $registration)
                <tr>
                    <td>{{ $registration->full_name }}</td>
                    <td>{{ $registration->age }}</td>
                    <td>{{ $registration->gender }}</td>
                    <td>{{ $registration->phone }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->address }}</td>
                    <td><span class="badge">{{ $registration->marathon_category }}</span></td>
                    <td>{{ $registration->registration_date }}</td>
                    <td>{{ $registration->emergency_contact_name }}</td>
                    <td>{{ $registration->emergency_contact_phone }}</td>
                    <td>{{ $registration->experience_level }}</td>
                    <td>{{ $registration->shirt_size }}</td>

                    <td>
    <div class="actions">
        <a href="{{ route('partials.editregister', $registration->id) }}" class="btn edit">Edit</a>

        <form action="{{ route('partials.destroy', $registration->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this runner?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn delete">Delete</button>
        </form>
    </div>
</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>
<script>


    (function () {
        if (performance.getEntriesByType('navigation')[0]?.type === 'reload') {
            const url = new URL(window.location.href);
            ['query'].forEach(p => url.searchParams.delete(p));
            window.location.replace(url.toString());
        }
    })();

</script>

</body>
</html>