<?php


function obracun()
{
    global $db;
    // $db->update("UPDATE vl_proizvodi SET vrij_knjig = vrij_knjig - (pocetna_vrij * koef)");
    $db->update("UPDATE vl_proizvodi
                SET vrij_knjig = CASE
                    WHEN (vrij_knjig - (pocetna_vrij * koef)) < 0 THEN 0
                    ELSE vrij_knjig - (pocetna_vrij * koef)
                END;");
}

function tipoviChart()
{
    global $db;
    $result = $db->select("SELECT tip_id, COUNT(*) AS kolicina, vl_tipovi_proizvoda.tip FROM vl_proizvodi, vl_tipovi_proizvoda WHERE vl_tipovi_proizvoda.id=vl_proizvodi.tip_id GROUP BY tip_id;");
    echo json_encode($result["result"]);
}

function ucioniceChart()
{
    global $db;
    $result = $db->select("SELECT s.ucionica_id, u.oznaka, SUM(s.kolicina) AS kolicina_sum FROM vl_stanje s JOIN vl_ucionice u ON s.ucionica_id = u.id GROUP BY s.ucionica_id, u.oznaka;");
    echo json_encode($result["result"]);
}

function proizvodiBarkodovi()
{
    global $db;
    generatePNG();
    $result = $db->select("SELECT p.naziv, b.* FROM vl_barkodovi b, vl_proizvodi p WHERE b.proizvod_id=p.id;");
    echo json_encode($result["result"]);
}

function generatePNG()
{
    require_once "generate_barcodes.php";
    generate_barcodes_proizvodiPNG();
}


$allowed = array("obracun", "generirajBarkodove", "tipoviChart", "ucioniceChart", "proizvodiBarkodovi", "generatePNG");


if (in_array($sub_route, $allowed)) {
    call_user_func($sub_route);
}
