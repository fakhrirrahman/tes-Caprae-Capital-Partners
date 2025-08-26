<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caprae Leads Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
        }

        .dashboard-container {
            max-width: 950px;
            margin: 40px auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.10);
            padding: 40px 48px 48px 48px;
        }

        .dashboard-title {
            font-weight: 800;
            font-size: 2.5rem;
            letter-spacing: -1px;
        }

        .export-link {
            float: right;
            border-radius: 8px;
            font-weight: 500;
        }

        .lead-form .form-label,
        .filter-form .form-label {
            font-weight: 600;
            color: #22223b;
        }

        .lead-form .form-control,
        .filter-form .form-control {
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid #e0e3e8;
        }

        .btn-primary,
        .btn-success {
            min-width: 120px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        .btn-success {
            background: #22c55e;
            border-color: #22c55e;
        }

        .btn-success:hover {
            background: #16a34a;
            border-color: #16a34a;
        }

        .lead-form,
        .filter-form {
            margin-bottom: 28px;
        }

        .table thead th {
            background: #f1f3f6;
            font-weight: 700;
            color: #22223b;
            border-bottom: 2px solid #e0e3e8;
        }

        .table tbody tr {
            transition: background 0.2s;
        }

        .table tbody tr:hover {
            background: #f3f6fa;
        }

        .alert-success {
            border-radius: 8px;
            font-weight: 500;
        }

        @media (max-width: 991px) {
            .dashboard-container {
                padding: 24px 8px 32px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="d-flex align-items-center mb-4">
            <h1 class="flex-grow-1 mb-0 dashboard-title">Lead Dashboard</h1>
            <a href="{{ route('leads.export') }}" class="btn btn-outline-secondary export-link">Export CSV</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('leads.store') }}" class="row g-3 lead-form">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Company</label>
                <input type="text" name="company" class="form-control" placeholder="Company">
            </div>
            <div class="col-md-2">
                <label class="form-label">Position</label>
                <input type="text" name="position" class="form-control" placeholder="Position">
            </div>
            <div class="col-md-1">
                <label class="form-label">Score</label>
                <input type="number" name="score" class="form-control" placeholder="Score" min="0">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </div>
        </form>

        <form method="GET" action="{{ route('leads.index') }}" class="row g-2 filter-form align-items-end">
            <div class="col-auto">
                <label class="form-label mb-0">Filter by min score:</label>
            </div>
            <div class="col-auto">
                <input type="number" name="min_score" class="form-control" placeholder="Min Score">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success">Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
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
                    @forelse($leads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->company }}</td>
                        <td>{{ $lead->position }}</td>
                        <td>{{ $lead->score }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No leads found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $leads->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>