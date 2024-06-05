// DELETE TRANSACTION
function deleteTransaction(transactionId) {
  if (confirm("Apakah Anda yakin ingin menghapus transaksi ini?")) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../transactions/delete.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          alert("Transaksi berhasil dihapus.");
          location.reload();
        } else {
          console.log(xhr.responseText);
          alert(
            "Terjadi kesalahan saat menghapus transaksi: " +
              xhr.status +
              " - " +
              xhr.statusText
          );
        }
      }
    };
    xhr.send("transaction_id=" + encodeURIComponent(transactionId));
  }
}
