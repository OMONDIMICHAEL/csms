<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .receipt-container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #555; }
    </style>
</head>
<body>

    <div class="receipt-container">
        <h2>School Fee Receipt</h2>
        <p><strong>Student Name:</strong> {{ $fee->student->name }}</p>
        <p><strong>Phone:</strong> {{ $fee->student->phone }}</p>
        <p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>

        <table>
            <tr>
                <th>Total Fee</th>
                <td>KSh {{ number_format($fee->total_fee, 2) }}</td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td>KSh {{ number_format($fee->amount_paid, 2) }}</td>
            </tr>
            <tr>
                <th>Balance</th>
                <td>KSh {{ number_format($fee->balance, 2) }}</td>
            </tr>
        </table>

        <p class="footer">Thank you for your payment. Keep this receipt for your records.</p>
    </div>

</body>
</html>
