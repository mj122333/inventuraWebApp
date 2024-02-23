<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/countup@1.8.2/countUp.js"></script>
    <script src="/<?php echo APPFOLDER ?>/js/get_cookie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin</title>
</head>

<style>
    body {
        height: 100vh;
    }

    /* ::-webkit-scrollbar {
        width: 0;
        background-color: transparent;
    } */

    .ikona-parent {
        position: relative;
        overflow: hidden;
    }

    .ikona-parent:hover .ikona {
        /* font-size: 14em; */
        font-size: 10em;
        right: -35px;
        top: -20px;
    }

    .ikona {
        /* font-size: 12em; */
        font-size: 8em;
        color: #495057;
        position: absolute;
        right: -50px;
        top: -10px;
        transition: .5s;
    }
</style>

<body data-bs-theme="light">
    <script defer>
        $("body").attr('data-bs-theme', initialTheme);
    </script>


    <!-- <?php print_r($_SESSION); ?> -->

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include "views/header.php"; ?>


        <main class="d-flex flex-row" style="flex: 1; overflow: hidden;">
            <?php include "views/sidebar.php"; ?>

            <div class="p-3 bg-tertiary" style="overflow-y: scroll;">
                <div class="row gy-3">

                    <a style="height: fit-content;" class="col-12 col-md-3 link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/proizvodi">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-box-seam"></i></h5>
                                <p class="card-text fw-semibold">Ukupno različitih proizvoda</p>
                                <h1 id="count-up-proizvodi" class="fw-bold"></h1>
                            </div>
                        </div>
                    </a>

                    <a style="height: fit-content;" class="col-12 col-md-3 link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/evidencija?i=<?= $zadnja_inventura ?>">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-check-circle"></i></h5>
                                <p class="card-text fw-semibold">Evidencija</p>
                                <h1 id="count-up-evidencija" class="fw-bold"></h1>
                            </div>
                        </div>
                    </a>

                    <a style="height: fit-content;" class="col-12 col-md-3 link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/stanje">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-database-check"></i></h5>
                                <p class="card-text fw-semibold">Ukupno stavki na stanju</p>
                                <h1 id="count-up-stanje" class="fw-bold"></h1>
                            </div>
                        </div>
                    </a>

                    <a style="height: fit-content;" class="col-12 col-md-3 link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/profesori">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-person"></i></h5>
                                <p class="card-text fw-semibold">Broj profesora</p>
                                <h1 id="count-up-profesori" class="fw-bold"></h1>
                            </div>
                        </div>
                    </a>

                    <div style="height: fit-content;" class="col-12 col-md-6">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-stopwatch"></i></h5>
                                <!-- <p class="card-text fw-semibold">Započni inventuru</p> -->
                                <form action="" method="post" class="container col-8 rounded h-100">
                                    <?php if ($inventura_aktivna) { ?>
                                        <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-secondary container-fluid">
                                            <div>
                                                <span>ZAUSTAVI INVENTURU</span>
                                                <div id="counter"></div>
                                            </div>
                                        </button>
                                    <?php } else { ?>
                                        <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-primary container-fluid">
                                            <div>
                                                <span>ZAPOČNI INVENTURU</span>
                                            </div>
                                        </button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a style="height: fit-content;" class="col-12 col-md-3 link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/usporedba">
                        <div class="card border">
                            <div class="card-body">
                                <h5 class="btn btn-icon"><i class="bi bi-arrow-left-right"></i></h5>
                                <p class="card-text fw-semibold">Usporedba</p>
                                <p class="card-text text-success">Prikaz usporedbi zadnje evidencije i stanja</p>
                            </div>
                        </div>
                    </a>

                    <div class="col-12 col-md-6">
                        <div class="card border">
                            <a style="height: fit-content;" class="card-body link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/ucionice">
                                <h5 class="card-title">Učionice</h5>
                                <p class="card-text">Količina proizvoda u svakoj učionici</p>
                            </a>
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border pb-4">
                            <a style="height: fit-content;" class="card-body link-underline link-underline-opacity-0" href="<?php echo DS . APPFOLDER . DS ?>admin/ucionice">
                                <h5 class="card-title ">Tipovi proizvoda</h5>
                                <p class="card-text">Količina proizvoda prema tipu kojem pripadaju</p>
                                <div class="progress-circle p75">
                                    <span><?= getTipovi()["row_count"] ?> tipova proizvoda</span>
                                    <div class="left-half-clipper">
                                        <div class="first50-bar"></div>
                                        <div class="value-bar"></div>
                                    </div>
                                </div>
                                <p class="card-text text-success">5 najbrojnijih tipova i zbroj ostatka</p>
                            </a>
                            <div>
                                <canvas class="mx-auto" id="myChartPie"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- <a href="#" class="position-fixed d-flex align-items-center justify-content-center border rounded-circle bg-main" style="right: 50px; bottom: 50px; width: 75px; height: 75px;">
                <i class="bi bi-caret-up-fill"></i>
            </a> -->


            <!-- <div class="w-100 bg-tertiary d-flex flex-column p-5">
                <div class="row">
                    <div class="rounded border col-4">Inventura 1</div>
                    <div class="rounded border col-8">Inventura 2</div>
                </div>
                <div class="row">
                    <div class="rounded border col-4">Inventura 3</div>
                    <div class="rounded border col-8">Inventura 4</div>
                </div>
            </div> -->

            <!-- <div class="h-100 w-100">

                <div class="row h-25 my-5 m-0 p-0">
                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/evidencija?i=<?= $zadnja_inventura ?>" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">EVIDENCIJA</p>
                        <i class="ikona bi bi-check-circle"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/ucionice" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">UČIONICE</p>
                        <i class="ikona bi bi-book"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/profesori" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">PROFESORI</p>
                        <i class="ikona bi bi-people"></i>
                    </a>
                </div>

                <div class="row h-25 my-5 m-0 p-0">
                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/proizvodi" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">PROIZVODI</p>
                        <i class="ikona bi bi-box-seam"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/usporedba" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">USPOREDBA</p>
                        <i class="ikona bi bi-arrow-left-right"></i>
                    </a>

                    <a href="<?php echo DS . APPFOLDER . DS ?>admin/stanje" class="link-secondary link-underline-opacity-0 container ikona-parent shadow border h-100 py-3 col-3">
                        <p class="d-none d-lg-block">STANJE</p>
                        <i class="ikona bi bi-database-check"></i>
                    </a>
                </div>

                <div>
                    <form action="" method="post" class="container col-6 col-3-sm rounded h-100">
                        <?php if ($inventura_aktivna) { ?>
                            <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-warning container-fluid">
                                <div>
                                    <span>ZAUSTAVI INVENTURU</span>
                                    <div id="counter"></div>
                                </div>
                            </button>
                        <?php } else { ?>
                            <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-primary container-fluid">
                                <div>
                                    <span>ZAPOČNI INVENTURU</span>
                                </div>
                            </button>
                        <?php } ?>
                    </form>

                </div>
            </div> -->

            <!-- <div class="d-none">
                <form action="" method="post" class="container col-6 col-3-sm rounded h-100">
                    <?php if ($inventura_aktivna) { ?>
                        <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-warning container-fluid">
                            <div>
                                <span>ZAUSTAVI INVENTURU</span>
                                <div id="counter"></div>
                            </div>
                        </button>
                    <?php } else { ?>
                        <button type="submit" name="pokreni_inventuru" value="true" class="btn btn-primary container-fluid">
                            <div>
                                <span>ZAPOČNI INVENTURU</span>
                            </div>
                        </button>
                    <?php } ?>
                </form>

            </div> -->

    </div>

    </main>
    </div>
</body>


<script>
    const createUcioniceChart = async () => {
        try {
            const sessionCookie = getCookie("sessionid");
            const requestOptions = {
                headers: {
                    "Content-Type": "application/json",
                    Cookie: "sessionid=" + sessionCookie,
                },
            };

            const url = "/<?php echo APPFOLDER ?>/api/ucioniceChart";
            const response = await fetch(url, requestOptions);
            const data = await response.json();

            console.log(data);

            const ctxPie = document.getElementById('myChart');

            const chartData = {
                labels: data.map(item => item.oznaka),
                datasets: [{
                    label: "broj proizvoda",
                    data: data.map(item => item.kolicina_sum),
                    borderWidth: 1,
                }],
            };

            var pieChart = new Chart(ctxPie, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // document.getElementById('myChart').style.height = '300px';
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    createUcioniceChart();



    const createTipoviChart = async () => {
        try {
            let tipovi;

            const sessionCookie = getCookie("sessionid");
            const requestOptions = {
                headers: {
                    "Content-Type": "application/json",
                    Cookie: "sessionid=" + sessionCookie,
                },
            };

            const url = "/<?php echo APPFOLDER ?>/api/tipoviChart";
            const response = await fetch(url, requestOptions);
            const data = await response.json();

            console.log(data);

            const sortedKolicina = data.sort((a, b) => b.kolicina - a.kolicina);
            const top5Kolicina = sortedKolicina.slice(0, 5).map(item => ({
                label: item.tip,
                kolicina: item.kolicina
            }));
            const ostatakSum = sortedKolicina.slice(5).reduce((sum, item) => sum + item.kolicina, 0);
            tipovi = [...top5Kolicina, {
                label: "ostatak",
                kolicina: ostatakSum
            }];
            console.log(tipovi);

            const ctxPie = document.getElementById('myChartPie');

            const chartData = {
                labels: tipovi.map(item => item.label),
                datasets: [{
                    data: tipovi.map(item => item.kolicina),
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ],
                }],
            };

            var pieChart = new Chart(ctxPie, {
                type: 'pie',
                data: chartData,
            });

            document.getElementById('myChartPie').style.height = '300px';
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    createTipoviChart();


    document.addEventListener('DOMContentLoaded', function() {
        const c1 = new CountUp('count-up-proizvodi', 0, <?= getProizvodi()["row_count"]; ?>);
        c1.start();

        const c2 = new CountUp('count-up-evidencija', 0, <?= getEvidencija()["row_count"]; ?>);
        c2.start();

        const c3 = new CountUp('count-up-stanje', 0, <?= $db->select_one("SELECT SUM(kolicina) AS kolicina_sum FROM vl_stanje;")["result"]["kolicina_sum"]; ?>);
        c3.start();

        const c4 = new CountUp('count-up-profesori', 0, <?= getProfesori()["row_count"]; ?>);
        c4.start();
    });


    const startTimeStamp = new Date('<?php echo date('Y-m-d\TH:i:s', strtotime($pocetak_inventure)); ?>').getTime();

    function updateCounter() {
        const currentTimeStamp = new Date().getTime();
        const elapsedTimeInSeconds = Math.floor((currentTimeStamp - startTimeStamp) / 1000);

        const days = Math.floor(elapsedTimeInSeconds / 86400);
        const hours = Math.floor((elapsedTimeInSeconds % 86400) / 3600);
        const minutes = Math.floor((elapsedTimeInSeconds % 3600) / 60);
        const seconds = elapsedTimeInSeconds % 60;

        const formattedTime = `${formatTime(days)} : ${formatTime(hours)} : ${formatTime(minutes)} : ${formatTime(seconds)}`;
        document.getElementById('counter').textContent = formattedTime;
    }

    function formatTime(value) {
        return value < 10 ? `0${value}` : value;
    }

    setInterval(updateCounter, 1000);

    // Initial update
    updateCounter();
</script>

</html>