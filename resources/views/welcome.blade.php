<!DOCTYPE html>
<html>
<head>
    <title>Caprae Leads Dashboard</title>
</head>
<body>
<h1>Lead Dashboard</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('leads.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="company" placeholder="Company">
    <input type="text" name="position" placeholder="Position">
    <input type="number" name="score" placeholder="Score" min="0">
    <button type="submit">Add Lead</button>
</form>

<form method="GET" action="{{ route('leads.index') }}">
    <label>Filter by min score:</label>
    <input type="number" name="min_score">
    <button type="submit">Filter</button>
</form>

<a href="{{ route('leads.export') }}">Export CSV</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Position</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leads as $lead)
        <tr>
            <td>{{ $lead->name }}</td>
            <td>{{ $lead->email }}</td>
            <td>{{ $lead->company }}</td>
            <td>{{ $lead->position }}</td>
            <td>{{ $lead->score }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $leads->links() }}
</body>
</html>
