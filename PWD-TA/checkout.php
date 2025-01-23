<?php
// Koneksi ke database
include 'koneksi.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $ticket_type = $conn->real_escape_string($_POST['ticket_type']);
    $quantity = (int) $_POST['quantity'];

    // Harga tiket
    $ticket_prices = [
        "reguler" => 500000,
        "vip" => 1000000,
        "vvip" => 2000000,
    ];

    // Hitung total harga
    $total_price = $ticket_prices[$ticket_type] * $quantity;

    // Query untuk menyimpan data
    $sql = "INSERT INTO checkout (name, email, ticket_type, quantity, total_price) 
            VALUES ('$name', '$email', '$ticket_type', $quantity, $total_price)";

    if ($conn->query($sql) === TRUE) {
        $is_checkout = true;  // Menandakan bahwa checkout berhasil
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $is_checkout = false;
    }
} else {
    $is_checkout = false; // Form belum disubmit
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Checkout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-image: url('<?php echo $is_checkout ? "background1.png" : "background2.png"; ?>'); /* Ganti background berdasarkan status checkout */
      background-size: cover;
      background-position: center;
    }

    .container {
      max-width: 600px;
      width: 100%;
      padding: 20px;
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .container label {
      font-weight: bold;
      display: block;
      margin-top: 10px;
    }

    .container input,
    .container select,
    .container button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .container button {
      background-color: #007BFF;
      color: white;
      font-weight: bold;
      font-size: 16px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    .container button:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    .summary {
      margin-top: 20px;
      padding: 15px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .summary p {
      margin: 5px 0;
    }

    .btn-print {
      display: block;
      width: 100%;
      padding: 12px;
      text-align: center;
      background-color: #28a745;
      color: white;
      font-weight: bold;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 20px;
    }

    .btn-print:hover {
      background-color: #218838;
    }
  </style>
  <!-- Tambahkan jsPDF library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
  <div class="container">
    <?php if ($is_checkout): ?>
      <!-- Tampilkan ringkasan checkout -->
      <h1>Checkout Sukses</h1>
      <table class="summary">
        <tr>
          <td>Terima kasih,</td>
          <td><strong><?= htmlspecialchars($name) ?></strong></td>
        </tr>
        <tr>
          <td>Email</td>
          <td>: <?= htmlspecialchars($email) ?></td>
        </tr>
        <tr>
          <td>Jenis Tiket</td>
          <td>: <?= htmlspecialchars(ucfirst($ticket_type)) ?></td>
        </tr>
        <tr>
          <td>Jumlah Tiket</td>
          <td>: <?= htmlspecialchars($quantity) ?></td>
        </tr>
        <tr>
          <td>Total Harga</td>
          <td>: Rp <?= number_format($total_price, 0, ',', '.') ?></td>
        </tr>
      </table>
      
      <!-- Tombol untuk mencetak PDF -->
      <button class="btn-print" onclick="generatePDF()">Cetak Tiket</button>

      <script>
        // Fungsi untuk menghasilkan PDF menggunakan jsPDF
        function generatePDF() {
          const { jsPDF } = window.jspdf;
          const doc = new jsPDF();

          // Styling untuk PDF
          doc.setFontSize(18);
          doc.text('Tiket Konser', 105, 22, null, null, 'center');
          doc.setFontSize(12);
          doc.text('Terima kasih telah membeli tiket konser kami!', 105, 30, null, null, 'center');

          // Menambahkan garis pemisah
          doc.line(20, 35, 190, 35);

          
          doc.setFontSize(14);
          doc.text('Detail Tiket', 20, 50);
          doc.setFontSize(12);
          doc.text('Nama', 20, 60);
          doc.text(': <?= htmlspecialchars($name) ?>', 55, 60); 
          doc.text('Email', 20, 70); 
          doc.text(': <?= htmlspecialchars($email) ?>', 55, 70);
          doc.text('Jenis Tiket', 20, 80); 
          doc.text(': <?= htmlspecialchars(ucfirst($ticket_type)) ?>', 55, 80); 
          doc.text('Jumlah Tiket', 20, 90); 
          doc.text(': <?= htmlspecialchars($quantity) ?>', 55, 90); 
          doc.text('Total Harga', 20, 100); 
          doc.text(': Rp <?= number_format($total_price, 0, ',', '.') ?>', 55, 100);

          // Menambahkan garis pemisah
          doc.line(20, 110, 190, 110); // Menggeser garis ke bawah

          // Menambahkan catatan
          doc.setFontSize(10);
          doc.text('* Harap membawa tiket ini saat masuk ke konser.', 20, 120); // Menggeser teks ke bawah

          // Menambahkan kotak di sekitar teks
          doc.setDrawColor(0);
          doc.setLineWidth(0.5);
          doc.rect(15, 15, 180, 110);

          // Simpan PDF
          doc.save('tiket-<?= htmlspecialchars($name) ?>.pdf');
        }
      </script>
    <?php else: ?>
      <!-- Tampilkan form checkout -->
      <h1>Form Checkout</h1>
      <form action="" method="POST">
        <!-- Nama Lengkap -->
        <label for="name">Nama Lengkap:</label>
        <input type="text" id="name" name="name" required>
        
        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <!-- Jenis Tiket -->
        <label for="ticket_type">Jenis Tiket:</label>
        <select id="ticket_type" name="ticket_type" required>
          <option value="regular">Regular - Rp 500,000</option>
          <option value="vip">VIP - Rp 1,000,000</option>
          <option value="vvip">VVIP - Rp 2,000,000</option>
        </select>
        
        <!-- Jumlah Tiket -->
        <label for="quantity">Jumlah Tiket:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>
        
        <!-- Tombol Submit -->
        <button type="submit">Lanjutkan Pembayaran</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>