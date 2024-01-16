<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Sahabat Mandiri</title>
    <style>
        /* Resetting default margin and padding */
        body, h1, p {
            margin: 0;
            padding: 0;
        }
        
        /* Styling email container */
        .email-container {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        
        /* Styling header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        /* Styling company name */
        .company-name {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        
        /* Styling email content */
        .email-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Styling email footer */
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 class="company-name">Sahabat Mandira</h1>
        </div>
        <div class="email-content">
            <p>Halo, {{ $namauser }}</p><br>

            {{ $konten }}   
            
            <br><br><p>Terima kasih atas perhatian Anda.</p>
            <p>Salam,</p>
            <p>Tim Sahabat Mandiri</p>
        </div>
        <div class="footer">
            <p>Email ini dikirim oleh Sahabat Mandira. Jika Anda memiliki pertanyaan, silakan hubungi kami di info@sahabatmandiria.com</p>
        </div>
    </div>
</body>
</html>
