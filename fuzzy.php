<?php include_once('_header.php'); ?>

<div class="box">
    <h1>Perhitungan Fuzzy</h1>
    <p>Menghitung debit irigasi tanaman padi<br><br><br></p>
    <form method="post" action="">
        <div class="form-group row">
            <label class="col-sm-2">Umur</label>
            <div class="col-sm-10">
                <input type="number" name="umur" step=0.01 class="form-control" placeholder="Masukkan Umur Anda" value="<?php if (isset($_POST["submit"])) echo $_POST["umur"]
                                                                                                                        ?>" required autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Berat Badan</label>
            <div class="col-sm-10">
                <input type="number" name="berat" step=0.01 class="form-control" placeholder="Masukkan Berat Badan Anda" value="<?php if (isset($_POST["submit"])) echo $_POST["berat"]
                                                                                                                                ?>" required autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Tinggi Badan</label>
            <div class="col-sm-10">
                <input type="number" name="tinggi" step=0.01 class="form-control" placeholder="Masukkan Tinggi Badan Anda" value="<?php if (isset($_POST["submit"])) echo $_POST["tinggi"]
                                                                                                                                    ?>" required autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Stadium</label>
            <div class="col-sm-10">
                <input type="number" name="stadium" step=0.01 class="form-control" placeholder="Masukkan Stadium Penyakit Anda" value="<?php if (isset($_POST["submit"])) echo $_POST["stadium"]
                                                                                                                                        ?>" required autocomplete="off">
            </div>
        </div>


        <!-- <div class="form-group row">
            <label class="col-sm-2">Suhu</label>
            <div class="col-sm-10">
                <input type="number" name="suhu" step=0.01 class="form-control" placeholder="Masukkan Suhu 1-100 °C" value="<?php //if (isset($_POST["submit"])) echo $_POST["suhu"]
                                                                                                                            ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Kelembapan</label>
            <div class="col-sm-10">
                <input type="number" name="kelembapan" step=0.01 class="form-control" placeholder="Masukkan Kelembapan 1-100 %" value="<?php //if (isset($_POST["submit"])) echo $_POST["kelembapan"]
                                                                                                                                        ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Tinggi Air</label>
            <div class="col-sm-10">
                <input type="number" name="tinggiair" step=0.01 class="form-control" placeholder="Masukkan Tinggi Air 1-15 cm" value="<?php //if (isset($_POST["submit"])) echo $_POST["tinggiair"]
                                                                                                                                        ?>" required>
            </div>
        </div> -->
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
include "_fuzzy.php";

if (isset($_POST["submit"])) {
?>
    <div class="card card-body">
    <?php
    //grafik suhu
    grafikfungsikeanggotaanumur();
    nilaigrafikumur($_POST["umur"]);

    //grafik kelembapan
    grafikfungsikeanggotaanberatbadan();
    nilaigrafikberatbadan($_POST["berat"]);

    //grafik tinggi air
    grafikfungsikeanggotaantinggibadan();
    nilaigrafiktinggibadan($_POST["tinggi"]);

    //grafik stadium
    grafikfungsikeanggotaanstadium();
    nilaigrafikstadium($_POST["stadium"]);


    //output
    grafikoutput();
    // gambarrules();


    hasilfuzzifikasi($_POST["umur"], $_POST["berat"], $_POST["tinggi"], $_POST["stadium"]);

    inferensi($_POST["umur"], $_POST["berat"], $_POST["tinggi"], $_POST["stadium"]);
    exit;
    echo "</div>";
}

include_once('_foother.php');
    ?>