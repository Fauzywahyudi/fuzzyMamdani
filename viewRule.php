<h4>Data Rule</h4>
<div class="card-body">
    <p></p>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Rule</th>
                <th>Rule</th>
                <th>Then</th>
            </tr>
        </thead>
        <tbody>
            <?php

            include 'koneksi.php';
            $sql = $kon->query("SELECT * FROM rule a INNER JOIN himpunan b ON a.then_rule=b.id_himpunan ORDER BY a.kode_rule ASC");
            $no = 1;
            while ($data = $sql->fetch_assoc()) {
                $rules = "IF ";
                $dataRule = json_decode($data['if_rule']);
                $index = 0;
                foreach ($dataRule as $key) {
                    $sqlRule = $kon->query("SELECT b.nama_variabel,a.nama_himpunan FROM himpunan a INNER JOIN variabel b ON a.id_variabel=b.id_variabel WHERE a.id_himpunan=$key ORDER BY id_himpunan");
                    $dataNama = $sqlRule->fetch_assoc();
                    if ($index == 0) {
                        $rules = $rules . $dataNama['nama_variabel'] . " IS " . $dataNama['nama_himpunan'] . " ";
                    } else {
                        $rules = $rules . " AND " . $dataNama['nama_variabel'] . " IS " . $dataNama['nama_himpunan'];
                    }
                    $index++;
                }

            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['kode_rule'] ?></td>
                    <td><?php echo  $rules ?></td>
                    <td><?php echo $data['nama_himpunan'] ?></td>

                </tr>
            <?php
                $no++;
            }
            if ($sql->num_rows < 1) {
            ?>
                <tr>
                    <th colspan="5">
                        <center>Data Kosong</center>
                    </th>
                </tr>
            <?php
            }

            ?>


        </tbody>

    </table>
</div>