<?php
function grafikfungsikeanggotaanumur()
{
?>
<h5>Fungsi Keanggotaan Umur</h5>
<img src="_assets/img/grafik/umur.png" class="img-fluid" alt="Grafik Suhu">
<br>
<?php
}
function grafikfungsikeanggotaanberatbadan()
{
?>
<h5>Fungsi Keanggotaan Berat Badan</h5>
<img src="_assets/img/grafik/beratbadan.png" class="img-fluid" alt="Grafik Kelembapan">
<br>
<?php
}
function grafikfungsikeanggotaantinggibadan()
{
?>
<h5>Fungsi Keanggotaan Tinggi Badan</h5>
<img src="_assets/img/grafik/tinggibadan.png" class="img-fluid" alt="Grafik Tinggi Air">
<br>
<?php
}
function grafikfungsikeanggotaanstadium()
{
?>
<h5>Fungsi Keanggotaan Stadium Kanker</h5>
<img src="_assets/img/grafik/stadium.png" class="img-fluid" alt="Grafik Tinggi Air">
<br>
<?php
}

function grafikoutput()
{
?>
<h4>Output</h4>
<p>Outputnya adalah Status Gizi</p>
<img src="_assets/img/grafik/statusgizi.png" class="img-fluid" alt="Grafik Debit Irigasi">
<br>
<?php
}
function gambarrules()
{
    include 'koneksi.php';
    include 'viewRule.php';
}
function nilaigrafikumur($umur)
{
    if (suhuminimum($umur) != 0) {
        echo "Dewasa (" . suhuminimum($umur) . ")";
        echo "<br>";
    }
    if (suhuoptimal($umur) != 0) {
        echo "Paruh Baya (" . suhuoptimal($umur) . ")";
        echo "<br>";
    }
    if (suhumaksimal($umur) != 0) {
        echo "Tua (" . suhumaksimal($umur) . ")";
        echo "<br>";
    }
    echo "<br>";
}
function nilaigrafikberatbadan($beratbadan)
{
    if (tidaklembab($beratbadan) != 0) {
        echo "Ringan (" . tidaklembab($beratbadan) . ")";
        echo "<br>";
    }
    if (sangatsesuai($beratbadan) != 0) {
        echo "Sedang (" . sangatsesuai($beratbadan) . ")";
        echo "<br>";
    }
    if (lembab($beratbadan) != 0) {
        echo "Berat (" . lembab($beratbadan) . ")";
        echo "<br>";
    }
    echo "<br>";
}
function nilaigrafiktinggibadan($tinggibadan)
{
    if (tinggiairkering($tinggibadan) != 0) {
        echo "Rendah (" . tinggiairkering($tinggibadan) . ")";
        echo "<br>";
    }
    if (tinggiairideal($tinggibadan) != 0) {
        echo "Sedang (" . tinggiairideal($tinggibadan) . ")";
        echo "<br>";
    }
    if (tinggiairbanjir($tinggibadan) != 0) {
        echo "Tinggi (" . tinggiairbanjir($tinggibadan) . ")";
        echo "<br>";
    }
    echo "<br>";
}

function nilaigrafikstadium($stadium)
{
    if (stadiumtidakganas($stadium) != 0) {
        echo "Tidak Ganas (" . stadiumtidakganas($stadium) . ")";
        echo "<br>";
    }
    if (stadiumsedang($stadium) != 0) {
        echo "Sedang (" . stadiumsedang($stadium) . ")";
        echo "<br>";
    }
    if (stadiumganas($stadium) != 0) {
        echo "Ganas (" . stadiumganas($stadium) . ")";
        echo "<br>";
    }
    echo "<br>";
}

function hasilfuzzifikasi($umur, $berat, $tinggi, $stadium)
{
    echo "<h4><b>Hasil Fuzzifikasi: </b></h4>";
    echo "<p><b>Nilai Fuzzy Umur: </b></p>";
    nilaigrafikumur($umur);
    echo "<p><b>Nilai Fuzzy Berat Badan: </b></p>";
    nilaigrafikberatbadan($berat);
    echo "<p><b>Nilai Fuzzy Tinggi Badan: </b></p>";
    nilaigrafiktinggibadan($tinggi);
    echo "<p><b>Nilai Fuzzy Stadium: </b></p>";
    nilaigrafikstadium($stadium);
}
function inferensi($umur, $berat, $tinggi, $stadium)
{
    include 'koneksi.php';
    echo "<h4><b>Rules yang digunakan: </b></h4>";
    $x = 0;
    $no = 1;
    $kondisi = [];
    $then = [];
    $nilaisuhu = [suhuminimum($umur), suhuoptimal($umur), suhumaksimal($umur)];
    $nilaikelembapan = [tidaklembab($berat), sangatsesuai($berat), lembab($berat)];
    $nilaitinggiair = [tinggiairkering($tinggi), tinggiairideal($tinggi), tinggiairbanjir($tinggi)];
    $nilaistadium = [stadiumtidakganas($stadium), stadiumsedang($stadium), stadiumganas($stadium)];

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            for ($k = 0; $k < 3; $k++) {
                for ($l = 0; $l < 3; $l++) {
                    if (($nilaisuhu[$i] > 0) && ($nilaikelembapan[$j] > 0) && ($nilaitinggiair[$k] > 0) && $nilaistadium[$l]) {
                        $minimal[$x] = min($nilaisuhu[$i], $nilaikelembapan[$j], $nilaitinggiair[$k], $nilaistadium[$l]);
                        if ($i == 0) {
                            $iname = "Dewasa";
                        } else if ($i == 1) {
                            $iname = "Paruh Baya";
                        } else {
                            $iname = "Tua";
                        }
                        if ($j == 0) {
                            $jname = "Ringan";
                        } else if ($j == 1) {
                            $jname = "Sedang";
                        } else {
                            $jname = "Berat";
                        }
                        if ($k == 0) {
                            $kname = "Rendah";
                        } else if ($k == 1) {
                            $kname = "Sedang";
                        } else {
                            $kname = "Tinggi";
                        }
                        if ($l == 0) {
                            $lname = "Tidak Ganas";
                        } else if ($l == 1) {
                            $lname = "Sedang";
                        } else {
                            $lname = "Ganas";
                        }

                        $rule = "IF Umur IS $iname AND Berat Badan IS $jname AND Tinggi Badan IS $kname AND Stadium IS $lname";

                        // $sql = $kon->query("SELECT * FROM rule a INNER JOIN himpunan b ON a.then_rule=b.id_himpunan ORDER BY a.kode_rule ASC");
                        // $no = 0;
                        // while ($data = $sql->fetch_assoc()) {
                        //     $rules = "IF ";
                        //     $dataRule = json_decode($data['if_rule']);
                        //     $index = 0;
                        //     foreach ($dataRule as $key) {
                        //         $sqlRule = $kon->query("SELECT b.nama_variabel,a.nama_himpunan FROM himpunan a INNER JOIN variabel b ON a.id_variabel=b.id_variabel WHERE a.id_himpunan=$key ORDER BY id_himpunan");
                        //         $dataNama = $sqlRule->fetch_assoc();
                        //         if ($index == 0) {
                        //             $rules = $rules . $dataNama['nama_variabel'] . " IS " . $dataNama['nama_himpunan'] . " ";
                        //         } else {
                        //             $rules = $rules . " AND " . $dataNama['nama_variabel'] . " IS " . $dataNama['nama_himpunan'];
                        //         }
                        //         $index++;
                        //     }
                        //     echo $data['nama_himpunan'];

                        //     if ($rule == $rules) {
                        //         echo $then[$no] = $data['nama_himpunan'];
                        //         break;
                        //     }
                        //     $no++;
                        // }




                        // if($minimal[$x])
                        if ($i == 2) {
                            $kondisi[$x] = "Normal";
                            // } else if (($i == 2) && ($k == 1) && ($j < 2)) {
                            //     $kondisi[$x] = "Normal";
                        } else {
                            $kondisi[$x] = "Buruk";
                        }
                        echo "<p>(R0" . $no . ") <br>IF Umur = $iname (" . $nilaisuhu[$i] . ") AND Berat Badan = $jname (" . $nilaikelembapan[$j] . ") AND Tinggi Badan = $kname (" . $nilaitinggiair[$k] . ") AND Stadium = $lname (" . $nilaistadium[$l] . ") THEN Status Gizi = " . $kondisi[$x] . " (" . $minimal[$x] . ")</p>";
                        $x++;
                    }
                    $no++;
                }
            }
        }
    }
    // exit;
    //Nilai Fuzzy Output
    $nilai_banyak = 0;
    $nilai_sedikit = 0;
    for ($l = 0; $l < $x; $l++) {
        if ($kondisi[$l]  == "Normal") {
            $nilai_banyak = max($minimal[$l], $nilai_banyak);
        } else {
            $nilai_sedikit = max($minimal[$l], $nilai_sedikit);
        }
    }
    echo "<h4><b>Nilai Fuzzy Output: </b></h4>";
    echo "<p>Status Gizi Normal(" . $nilai_banyak . ")</p>";
    echo "<p>Status Gizi Buruk ( " . $nilai_sedikit . ")</p>";
    //Defuzzifikasi
    echo '<h4><b>Defuzzifikasi</b></h4>';
    echo '<p>Menggunakan metode Centroid Method</p>';
    // echo '<img src="_assets/img/defuzzifikasi.jpg" class="img-fluid" alt="Grafik Debit Irigasi">';
    // echo '<p>Sampel yang diambil adalah titik 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10. Kemudian dimasukkan ke dalam rumus:</p>';
    // print_r($kondisi);
    // exit;
    echo $a1 = nilaiX($nilai_banyak, 10, 50);
    echo "<br>";
    echo $a2 = nilaiX($nilai_sedikit, 10, 50);
    echo "<br>";
    echo $a = simpleIntegral($nilai_banyak, 1, 0, $a1);
    echo "<br>";

    echo $c = simpleIntegral($nilai_sedikit, 1, $a2, 50);
    exit;
    echo '<img src="https://latex.codecogs.com/svg.latex?y*&space;=&space;\frac{((0&plus;1&plus;2&plus;3&plus;4)*' . $nilai_sedikit . ')&plus;((5)*0,5)&plus;((6&plus;7&plus;8&plus;9&plus;10)*' . $nilai_banyak . ')}{((5)*' . $nilai_sedikit . ')&plus;((1)*0,5)&plus;((5)*' . $nilai_banyak . ')}"/>';
    $nilaiy = ((10 * $nilai_sedikit) + (40 * $nilai_banyak) + 0.5) / ((5 * $nilai_sedikit) + (5 * $nilai_banyak) + 0.5);
    echo "<br><h4><b>Banyaknya Debit Irigasi (y*)= </b>" . $nilaiy . " L/s/Ha</h4>";

    // echo '<img src="https://latex.codecogs.com/svg.latex?y*&space;=&space;\frac{((0&plus;1&plus;2&plus;3&plus;4)*0.6)&plus;((5)*0,5)&plus;((6&plus;7&plus;8&plus;9&plus;10)*0.2)}{((5)*0.6)&plus;((1)*0,5)&plus;((5)*0.2)}"/>';
}
function suhuminimum($suhu)
{
    $nilaisuhuminimum = 0;
    //suhu minimum
    if ($suhu <= 30) {
        $nilaisuhuminimum = 1;
    } else {
        if ($suhu < 50) {
            $nilaisuhuminimum = (25 - $suhu) / 20;
        } else {
            $nilaisuhuminimum = 0;
        }
    }
    return $nilaisuhuminimum;
}
function suhuoptimal($suhu)
{
    $nilaisuhuoptimal = 0;
    //suhu optimal
    if ($suhu >= 30 && $suhu <= 70) {
        if ($suhu == 50) {
            $nilaisuhuoptimal = 1;
        } else {
            if ($suhu >= 30 && $suhu < 50) {
                $nilaisuhuoptimal = ($suhu - 30) / 20;
            } else {
                if ($suhu > 50 && $suhu <= 70) {
                    $nilaisuhuoptimal = (70 - $suhu) / 20;
                } else {
                    $nilaisuhuoptimal = 0;
                }
            }
        }
    }
    return $nilaisuhuoptimal;
}
function suhumaksimal($suhu)
{
    $nilaisuhumaksimal = 0;
    //suhu maksimal
    if ($suhu >= 70) {
        $nilaisuhumaksimal = 1;
    } else {
        if ($suhu >= 50 && $suhu < 70) {
            $nilaisuhumaksimal = ($suhu - 50) / 20;
        } else {
            $nilaisuhumaksimal = 0;
        }
    }
    return $nilaisuhumaksimal;
}
function tidaklembab($kelembapan)
{
    $kelembapantidaklembab = 0;
    //tidak LEMBAB
    if ($kelembapan <= 30) {
        $kelembapantidaklembab = 1;
    } else {
        if ($kelembapan < 55) {
            $kelembapantidaklembab = (55 - $kelembapan) / 25;
        } else {
            $kelembapantidaklembab = 0;
        }
    }
    return $kelembapantidaklembab;
}
function sangatsesuai($kelembapan)
{
    $nilaikelembapansangatsesuai = 0;
    //sangat sesuai
    if ($kelembapan >= 30 && $kelembapan <= 80) {
        if ($kelembapan == 55) {
            $nilaikelembapansangatsesuai = 1;
        } else {
            if ($kelembapan >= 30 && $kelembapan < 55) {
                $nilaikelembapansangatsesuai = ($kelembapan - 30) / 25;
            } else {
                if ($kelembapan > 55 && $kelembapan <= 80) {
                    $nilaikelembapansangatsesuai = (80 - $kelembapan) / 25;
                } else {
                    $nilaikelembapansangatsesuai = 0;
                }
            }
        }
    }
    return $nilaikelembapansangatsesuai;
}
function lembab($kelembapan)
{
    $kelembapanlembab = 0;
    //LEMBAB
    if ($kelembapan >= 80) {
        $kelembapanlembab = 1;
    } else {
        if ($kelembapan >= 55 && $kelembapan < 80) {
            $kelembapanlembab = ($kelembapan - 55) / 25;
        } else {
            $kelembapanlembab = 0;
        }
    }
    return $kelembapanlembab;
}
function tinggiairkering($tinggiair)
{
    $nilaitinggiairkering = 0;
    //tinggi air kering
    if ($tinggiair <= 140) {
        $nilaitinggiairkering = 1;
    } else {
        if ($tinggiair <= 160) {
            $nilaitinggiairkering = (160 - $tinggiair) / 20;
        } else {
            $nilaitinggiairkering = 0;
        }
    }
    return $nilaitinggiairkering;
}
function tinggiairideal($tinggiair)
{
    $nilaitinggiairideal = 0;
    //tinggi air ideal
    if ($tinggiair >= 140 && $tinggiair <= 180) {
        if ($tinggiair == 160) {
            $nilaitinggiairideal = 1;
        } else {
            if ($tinggiair >= 140 && $tinggiair < 160) {
                $nilaitinggiairideal = ($tinggiair - 140) / 20;
            } else {
                if ($tinggiair > 160 && $tinggiair <= 180) {
                    $nilaitinggiairideal = (180 - $tinggiair) / 20;
                } else {
                    $nilaitinggiairideal = 0;
                }
            }
        }
    }
    return $nilaitinggiairideal;
}
function tinggiairbanjir($tinggiair)
{
    $nilaitinggiairbanjir = 0;
    //tinggi air banjir
    if ($tinggiair >= 180) {
        $nilaitinggiairbanjir = 1;
    } else {
        if ($tinggiair >= 160 && $tinggiair <= 180) {
            $nilaitinggiairbanjir = ($tinggiair - 160) / 20;
        } else {
            $nilaitinggiairbanjir = 0;
        }
    }
    return $nilaitinggiairbanjir;
}
function stadiumtidakganas($stadium)
{
    $nilaistadium = 0;
    //tinggi air kering
    if ($stadium <= 1) {
        $nilaistadium = 1;
    } else {
        if ($stadium <= 2) {
            $nilaistadium = (2 - $stadium) / 1;
        } else {
            $nilaistadium = 0;
        }
    }
    return $nilaistadium;
}
function stadiumsedang($stadium)
{
    $nilaistadium = 0;
    //tinggi air ideal
    if ($stadium >= 1 && $stadium <= 4) {
        if ($stadium >= 2 && $stadium <= 3) {
            $nilaistadium = 1;
        } else {
            if ($stadium >= 1 && $stadium < 2) {
                $nilaistadium = ($stadium - 1) / 1;
            } else {
                if ($stadium > 3 && $stadium <= 4) {
                    $nilaistadium = (4 - $stadium) / 1;
                } else {
                    $nilaistadium = 0;
                }
            }
        }
    }
    return $nilaistadium;
}
function stadiumganas($stadium)
{
    $nilaistadium = 0;
    //tinggi air banjir
    if ($stadium >= 4) {
        $nilaistadium = 1;
    } else {
        if ($stadium >= 3 && $stadium <= 4) {
            $nilaistadium = ($stadium - 3) / 1;
        } else {
            $nilaistadium = 0;
        }
    }
    return $nilaistadium;
}

function nilaiX($sama, $min, $max)
{
    $x1 = 0;
    $x1 = ($max * $sama) + $min;
    return $x1;
}

function simpleIntegral($value, $pow, $min, $max)
{
    $result = 0;

    if ($min == 0) {
        $result = pow($max, $pow + 1) * ($value / ($pow + 1));
    } else {
        $result = pow($max, $pow + 1) * ($value / ($pow + 1)) - pow($min, $pow + 1) * ($value / ($pow + 1));
    }
    return $result;
}

function midIntegral($value, $pow, $min, $max)
{
}
?>