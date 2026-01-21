<?php
require_once 'engine.php';

$username = 'admin1'; 
$password_baru = '123';

$hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);

try {
    $sql = "UPDATE Admin SET password = :p WHERE Username = :u";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':p' => $hash_baru,
        ':u' => $username
    ]);

    echo "<h1>Berhasil!</h1>";
    echo "Password untuk user <b>$username</b> telah direset menjadi: <b>$password_baru</b><br>";
    echo "Hash baru di database: $hash_baru<br><br>";
    echo "<a href='login.php'>Coba Login Sekarang</a>";

} catch (PDOException $e) {
    echo "<h1>Gagal!</h1>";
    echo "Error: " . $e->getMessage();
}
?>
