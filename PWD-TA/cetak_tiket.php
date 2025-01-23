<?php
// Simulasi data dari form checkout sebelumnya
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ticket_type = $_POST['ticket_type'];
    $quantity = $_POST['quantity'];

    // Harga tiket
    $ticket_prices = [
        "regular" => 500000,
        "vip" => 1000000,
        "vvip" => 2000000,
    ];

    // Hitung total harga
    $total_price = $ticket_prices[$ticket_type] * $quantity;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiket Anda</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f4f4f9;
    }

    .ticket-container {
      width: 80%;
      max-width: 600px;
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .ticket-container h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .ticket-info {
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 5px;
      background-color: #f9f9f9;
      margin-bottom: 20px;
    }

    .ticket-info p {
      margin: 5px 0;
      font-size: 16px;
    }

    .ticket-info .bold {
      font-weight: bold;
    }

    .ticket-info .highlight {
      color: #007BFF;
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
      transition: background-color 0.3s, transform 0.2s;
    }

    .btn-print:hover {
      background-color: #218838;
      transform: scale(1.05);
    }
  </style>
</head>
<body>
  <div class="ticket-container">
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <!-- Tampilkan tiket -->
      <h1>Tiket Anda</h1>
      <div class="ticket-info">
        <p><span class="bold">Nama:</span> <?= htmlspecialchars($name) ?></p>
        <p><span class="bold">Email:</span> <?= htmlspecialchars($email) ?></p>
        <p><span class="bold">Jenis Tiket:</span> <?= htmlspecialchars(ucfirst($ticket_type)) ?></p>
        <p><span class="bold">Jumlah Tiket:</span> <?= htmlspecialchars($quantity) ?></p>
        <p><span class="bold">Total Harga:</span> Rp <?= number_format($total_price, 0, ',', '.') ?></p>
        <p><span class="bold">Tanggal Acara:</span> <span class="highlight">Sabtu, 4 Januari 2025</span></p>
        <p><span class="bold">Lokasi:</span> Jakarta International Stadium</p>
      </div>

      <!-- Tombol untuk mencetak -->
      <button class="btn-print" onclick="window.print()">Cetak Tiket</button>
    <?php else: ?>
      <p>Tiket tidak tersedia. Mohon lengkapi formulir checkout terlebih dahulu.</p>
    <?php endif; ?>
  </div>
</body>
</html>
