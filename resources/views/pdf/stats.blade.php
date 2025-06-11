<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <title>Library Statistics Report</title>
    <style>
        body {
            background-color: white;
            padding: 2rem;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1f2937;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .header h1 {
            font-size: 1.875rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        .header p {
            color: #4b5563;
        }
        .section {
            margin-bottom: 2rem;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #1f2937;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #d1d5db;
        }
        th {
            background-color: #f3f4f6;
            text-align: left;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
        }
        td {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
        }
        .footer {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Library Statistics Report</h1>
        <p>Generated on: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Currently Lent Books</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Releases</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lentBooks as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->release }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Available Books</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Book Author</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($availableBooks as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Penalties</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Book Author</th>
                        <th>Days</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penalties as $penalty)
                    <tr>
                        <td>{{ $penalty->book_title }}</td>
                        <td>{{ $penalty->book_author }}</td>
                        <td>{{ $penalty->days }}</td>
                        <td>{{ $penalty->amount }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Most Lent Books</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Book Author</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostLentBooks as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Most Active Users</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mostActiveUsers as $user)
                    <tr>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>This is an automatically generated report. Please contact the library staff for any questions.</p>
    </div>
</body>
</html>
