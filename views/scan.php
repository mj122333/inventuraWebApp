<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Admin</title>
</head>

<style>
    body {
        height: 100vh;
    }
</style>

<body data-bs-theme="dark">

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include 'views/header.php'; ?>

        <main class="d-flex flex-row h-100">

            <div class="container-fluid row p-2 mx-0 h-100">


                <section id="skenSection" class="container" id="demo-content">

                    <div>
                        <a class="btn btn-success col-5 col-sm-3 col-md-2" id="startButton">Start</a>
                        <a class="btn btn-warning col-5 col-sm-3 col-md-2" id="resetButton">Reset</a>
                    </div>

                    <div>
                        <video class="col-12 col-sm-6 col-md-4" id="video" height="auto" style="border: 1px solid gray"></video>
                    </div>

                    <div class="col-12 col-sm-4" id="sourceSelectPanel" style="display:none">
                        <div class="input-group mb-3 col-6">
                            <label for="sourceSelect" class="input-group-text">Kamera</label>
                            <select id="sourceSelect" class="form-select" style="max-width:400px">
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3 col-12 col-sm-4">
                        <span class="input-group-text">Vrijednost</span>
                        <span id="result" class="input-group-text font-monospace"></span>
                        <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                    </div>

                    <div class="input-group mb-3 col-12 col-sm-4">
                        <span class="input-group-text">Učionica</span>
                        <span id="ucionica" class="input-group-text font-monospace"></span>
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                    </div>

                    <div class="input-group mb-3 col-12 col-sm-4">
                        <span class="input-group-text">Poruka</span>
                        <span id="response" class="input-group-text font-monospace"></span>
                        <span class="input-group-text"><i class="bi bi-code-slash"></i></span>
                    </div>

                    <button onclick="zamjenaUnosa()" class="btn btn-primary">Unesi ručno</button>

                </section>

                <section id="rucnoSection" class="col-12 col-md-6 col-lg-4 mx-0" style="display: none;">

                    <div class="input-group mb-3">
                        <span class="input-group-text">Vrijednost</span>
                        <input type="text" id="vrijednost" class="form-control font-monospace"></input>
                        <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Učionica</span>
                        <!-- <input type="text" id="ucionicaRucno" class="form-control font-monospace"></input> -->
                        <select id="ucionicaSelect" class="form-select">
                            <option value>Odaberi učionicu</option>
                            <?php
                            $ucionice = $result = $db->select("SELECT * FROM vl_ucionice");
                            foreach ($ucionice["result"] as $row) {
                            ?>
                                <option value="<?= $row["id"] ?>"><?= $row["oznaka"] ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Poruka</span>
                        <span id="responseRucno" class="input-group-text font-monospace"></span>
                        <span class="input-group-text"><i class="bi bi-code-slash"></i></span>
                    </div>

                    <button onclick="posaljiPodatke()" class="col-5 col-sm-3 btn btn-success">Pošalji</button>
                    <button onclick="zamjenaUnosa()" class="col-5 col-sm-3 btn btn-primary">Skeniraj</button>

                </section>

            </div>

        </main>

    </div>

    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>
    <script type="text/javascript">
        function zamjenaUnosa() {
            $('#skenSection').toggle();
            $('#rucnoSection').toggle();
            // sken = !sken;
        }

        function posaljiPodatke() {
            let vrijednost = $('#vrijednost').val();
            let ucionica_id = $('#ucionicaSelect').val();
            const params = {
                value: vrijednost,
                standard: "EAN_13",
                ucionica: ucionica_id,
                user: <?php echo $_SESSION["id"]; ?>,
            };

            console.log("Params:", params);
            console.log("ucionica_id", ucionica_id);

            const formData = new FormData();
            for (const key in params) {
                formData.append(key, params[key]);
            }

            fetch('upload', {
                    method: 'POST',
                    body: formData,
                    // Headers can be modified as needed, for example, to specify JSON
                    // headers: {
                    //   'Content-Type': 'application/json',
                    // },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response:', data)
                    $('#responseRucno').text(data["message"]);
                    $('#responseRucno').removeClass("text-success");
                    $('#responseRucno').removeClass("text-danger");
                    $('#responseRucno').addClass(data["status"] == "success" ? "text-success" : "text-danger");
                })
                .catch(error => console.error('Error:', error));
        }

        window.addEventListener('load', function() {

            // let sken = true;

            let barcodeFormats = ZXing.BarcodeFormat;
            let ucionica_id = null;

            let selectedDeviceId;
            const codeReader = new ZXing.BrowserMultiFormatReader(); // TODO kod ispod pretvoriti u jquery
            console.log('ZXing code reader initialized');
            codeReader.listVideoInputDevices()
                .then((videoInputDevices) => {
                    const sourceSelect = document.getElementById('sourceSelect');
                    selectedDeviceId = videoInputDevices[0].deviceId;
                    if (videoInputDevices.length >= 1) {
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option');
                            sourceOption.text = element.label;
                            sourceOption.value = element.deviceId;
                            sourceSelect.appendChild(sourceOption);
                        })

                        sourceSelect.onchange = () => {
                            selectedDeviceId = sourceSelect.value;
                        };

                        const sourceSelectPanel = document.getElementById('sourceSelectPanel');
                        sourceSelectPanel.style.display = 'block';
                    }

                    document.getElementById('startButton').addEventListener('click', () => {
                        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                            if (result) {
                                // console.log(result);

                                if (result.text != document.getElementById('result').textContent) {
                                    document.getElementById('result').textContent = result.text;
                                    // slanje post zahtjeva na server
                                    const params = {
                                        value: result.text,
                                        standard: barcodeFormats[result.format],
                                        ucionica: ucionica_id,
                                        user: <?php echo $_SESSION["id"]; ?>,
                                    };

                                    console.log(params);

                                    const formData = new FormData();
                                    for (const key in params) {
                                        formData.append(key, params[key]);
                                    }

                                    fetch('upload', {
                                            method: 'POST',
                                            body: formData,
                                            // Headers can be modified as needed, for example, to specify JSON
                                            // headers: {
                                            //   'Content-Type': 'application/json',
                                            // },
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Response:', data)
                                            $('#response').text(data["message"]);
                                            $('#response').removeClass("text-success");
                                            $('#response').removeClass("text-danger");
                                            $('#response').addClass(data["status"] == "success" ? "text-success" : "text-danger");

                                            if (data["vrsta"] == "ucionica") {
                                                $('#ucionica').text(data["oznaka"]);
                                                ucionica_id = data["ucionica_id"];
                                            }
                                            console.log("ucionica_id var: ", ucionica_id);
                                        })
                                        .catch(error => console.error('Error:', error));
                                }

                            }
                            if (err && !(err instanceof ZXing.NotFoundException)) {
                                console.error(err);
                                document.getElementById('result').textContent = err;
                            }
                        })
                        console.log(`Started continous decode from camera with id ${selectedDeviceId}`);
                    })

                    document.getElementById('resetButton').addEventListener('click', () => {
                        codeReader.reset();
                        document.getElementById('result').textContent = '';
                        console.log('Reset.');
                    })

                })
                .catch((err) => {
                    console.error(err);
                })
        })
    </script>

</body>

</html>