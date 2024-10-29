<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Guest Book</b></h4>
</div>

<?php
require '../function.php';

$book = [];
$query = mysqli_query($conn, "SELECT * FROM guest_book");
while($row = mysqli_fetch_assoc($query)){
    $book[] = $row;
}
?>

<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($book as $key => $value): ?>

                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $value['nama_guest'] ?></td>
                        <td><?= $value['email_guest'] ?></td>
                        <td><?= $value['pesan'] ?></td>
                    </tr>
                <?php
                    $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>
