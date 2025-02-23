<!DOCTYPE html>
<html>
<head>
    <title>Student Grades Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Grades Report</h2>
        <p>Name: {{ Auth::user()->name }}</p>
        <p>Class Level: {{ Auth::user()->class }}</p>

        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->subject->name }}</td>
                        <td>{{ $grade->marks }}</td>
                        <td>{{ $grade->grade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
