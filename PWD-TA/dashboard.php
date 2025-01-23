<?php
include 'header.php';

session_start();
// Cek apakah pengguna sudah login
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
  // Jika sesi login tidak ditemukan atau tidak valid, arahkan ke halaman index.php
  header("Location: index.php");
  exit();
}

?>


<style>
  .btn-logout {
  display: block;
  width: 100px;
  padding: 10px;
  text-align: center;
  background-color: #dc3545;
  color: white;
  font-weight: bold;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin: 20px auto;
  text-decoration: none;
}

.btn-logout:hover {
  background-color: #c82333;
}
</style>
<section class="section1">
  <section class="judul" style="margin-top: -180px;">
    <img src="judul.png" class="judul-img">
  </section>
    <div class="lokasi-info">
            <p><strong>Sabtu, 4 Januari 2025</strong></p>
            <p><strong>Jakarta International Stadium</strong></p>
            <p>Jakarta, Indonesia</p>
    </div>
</section>

<section class="section2">
  <section class="lineup">
    <img src="LineUp.png" class="lineup-img">
  </section>
  <table class="image-table">
          <tr>
          <td>
            <img src="lineup1.png" alt="lineup1" class="lineup1" style="width: 70%;"> 
            </a>
            <p style="text-align: center;"><b>Sheila On 7</b></p>
          </td>
          <td>
            <img src="lineup2.png" alt="lineup2" class="lineup2" style="width: 70%;">
            </a>
            <p style="text-align: center;"><b>DEWA 19</b></p>
          </td>
          <td>
            <img src="lineup3.png" alt="lineup3" class="lineup3" style="width: 70%;">
            </a>
            <p style="text-align: center;"><b>Efek Rumah Kaca</b></p>
          </td>
        </table>
</section>

<section class="section3">
  <section class="tickets">
    <img src="Tickets.png" class="tickets-img" alt="Tickets">
  </section>
  <div class="beli-tiket">
    <a href="checkout.php" class="btn-buy">Checkout</a>
  </div>
</section>

<section class="logout-section">
  <a href="logout.php" class="btn-logout">Logout</a>
</section>

<?php include 'footer.php'; ?>