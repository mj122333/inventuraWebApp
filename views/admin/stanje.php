<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "views/head_links.php"; ?>
    <title>Admin</title>
    <script src="/<?php echo APPFOLDER ?>/js/promjene.js"></script>
</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

<script>
    function tablePDF() {
        console.log("Generating PDF");

        var pdf = new jsPDF('p', 'pt', 'a4');
        source = $('#tableStanje')[0];

        specialElementHandlers = {
            '#bypassme': function(element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 1024
        };

        pdf.setFont('times');
        pdf.setFontSize(12);

        var currentDate = new Date();
        var day = ('0' + currentDate.getDate()).slice(-2); // Ensure two digits, pad with zero if necessary
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Months are zero-based, so add 1
        var year = currentDate.getFullYear();

        var formattedDate = day + '_' + month + '_' + year;

        pdf.autoTable({
            theme: 'plain',
            margin: {
                top: 20
            },
            didDrawPage: function(data) {
                pdf.text('Stanje ' + formattedDate.replaceAll("_", ".") + ".", data.settings.margin.left, 30, {
                    align: 'center'
                });
                // pdf.text('Page ' + data.pageNumber, data.settings.margin.left, 50);
            }
        });

        pdf.autoTable({
            html: source,
            startY: margins.top,
            theme: 'grid',
            margin: {
                left: margins.left,
                right: margins.left
            },
            headStyles: {
                fillColor: [200, 200, 200]
            },
            bodyStyles: {
                textColor: [0, 0, 0]
            },
            didDrawCell: function(data) {
                var barcodeElement = data.cell.raw;
                if (barcodeElement && barcodeElement.hasAttribute('data-image')) {
                    var barcodeImageSrc = barcodeElement.getAttribute('data-image');
                    var x = data.cell.x + 2; // Adjust x position
                    var y = data.cell.y + 2; // Adjust y position
                    var width = data.cell.width - 4; // Adjust width
                    var height = data.cell.height - 4; // Adjust height

                    var img = new Image();
                    img.onload = function() {
                        pdf.addImage(img, "png", x, y, width, height);
                    };
                    img.src = barcodeImageSrc;
                }
            },


            didDrawPage: function(data) {
                var totalPagesExp = '{total_pages_count_string}';
                var pageString = 'Stranica ' + pdf.internal.getNumberOfPages();
                pdf.setFontSize(10);
                var pageWidth = pdf.internal.pageSize.width;
                pdf.text(pageString, pageWidth - data.settings.margin.right - 20, pdf.internal.pageSize.height - 20);
            }
        });


        var fileName = 'stanje_' + formattedDate + '.pdf';
        pdf.save(fileName);
    }

    function barcodePDF() {
        const url = "/<?php echo APPFOLDER ?>/api/proizvodiBarkodovi";
        const sessionCookie = getCookie("sessionid");

        const headers = {
            "Content-Type": "application/json",
            Cookie: "sessionid=" + sessionCookie,
        };
        $.ajax({
            url: url,
            dataType: 'json',
            headers: headers,
            success: async function(data) {
                console.log(data);
                const pdf = new jsPDF();

                const columns = ['Vrijednost barkoda', 'Barkod', 'Naziv'];

                const rows = data.map(item => {
                    return [
                        item.barkod,
                        "/<?php echo APPFOLDER ?>/barcodes/code_" + item.barkod + ".png",
                        item.naziv
                    ];
                });

                console.log(rows);

                var index = 0;
                var column_index = 0;
                const imgWidth = 65;
                const imgHeight = 10;
                const spacer = 50;
                var counter = 0;
                rows.forEach(element => {
                    var image = new Image();
                    image.src = element[1];

                    try {
                        if (column_index % 2 == 0) {
                            pdf.text(10, index * (imgHeight + 15) + 5, element[2]);
                            pdf.addImage(image, 'PNG', 10, index * (imgHeight + 15) + 10, imgWidth, imgHeight);
                            pdf.text(10, index * (imgHeight + 15) + 20 + 10, element[0]);
                        } else {
                            pdf.text(imgWidth + spacer, index * (imgHeight + 15) + 5, element[2]);
                            pdf.addImage(image, 'PNG', imgWidth + spacer, index * (imgHeight + 15) + 10, imgWidth, imgHeight);
                            pdf.text(imgWidth + spacer, index * (imgHeight + 15) + 20 + 10, element[0]);
                            index += 1.7;
                        }
                    } catch {
                        console.log("Greška: " + image.src);
                    }
                    column_index++;
                    counter++;

                    if (counter == 14) {
                        pdf.addPage();
                        counter = column_index = index = 0;
                    }
                });

                pdf.save('barkodovi_inventura.pdf');
            },
            error: function(xhr, status, error) {
                console.error('API request failed:', status, error);
            }
        });
    }



    // function pdftest() {
    //     const doc = new jsPDF();
    //     const image = new Image();
    //     image.src = "/<?php echo APPFOLDER ?>/barcodes/code_1000290002110.png"
    //     console.log(image.src);
    //     doc.addImage(image, "png", 0, 0, 100, 100);
    //     doc.save("nekipdf.pdf");
    // }
</script>

<style>
    body {
        height: 100vh;
    }

    /* ::-webkit-scrollbar {
        width: 0;
    } */

    .custom-scrollbar {
        position: relative;
        /* height: 30rem; */
        height: 30rem;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .barcode {
        /* height: 50px; */
        height: 42px;
        overflow: hidden;
    }

    .barcode:hover {
        cursor: pointer;
    }

    .barcode img {
        height: 100%;
        width: auto;
        display: block;
    }
</style>

<body data-bs-theme="light">
    <script defer>
        $("body").attr('data-bs-theme', initialTheme);
    </script>

    <div class="h-100 d-flex flex-column" style="flex: 1;">

        <?php include 'views/header.php'; ?>

        <main class="d-flex flex-row h-100">

            <?php include 'views/sidebar.php'; ?>

            <div class="container-fluid mx-0 py-2 h-100 bg-tertiary" style="font-size: 10px">

                <h4>Stanje inventara</h1>

                    <div class="bg-main rounded p-3 border">

                        <form id="form" onsubmit="return false;">

                            <?php $result = getStanje(); ?>
                            <div class="d-flex justify-content-between">
                                <span class="fs-5 fw-bold"><?= $result["row_count"] ?> rezultat/a</span>

                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-filetype-pdf"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><button onclick="tablePDF()" class="dropdown-item btn btn-primary">Tablica u PDF</button></li>
                                        <li><button onclick="barcodePDF()" class="dropdown-item btn btn-primary">Barkodovi u PDF</button></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="table-wrapper-scroll-y custom-scrollbar">

                                <table id="tableStanje" class="darkTableToggle table table-hover table-borderless" style="font-size: 14px;">
                                    <?php
                                    if ($result["row_count"] > 0) {
                                    ?>
                                        <thead class="position-sticky" style="top: 0;">
                                            <tr>
                                                <!-- <th scope="col">Obriši</th> -->
                                                <th class="text-gray">ID</th>
                                                <!-- <th class="text-gray">Slika</th> -->
                                                <th class="text-gray">Proizvod</th>
                                                <th class="text-gray">Učionica</th>
                                                <th class="text-gray">Količina</th>
                                                <th class="text-gray">Barkod</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result["result"] as $row) { ?>
                                                <tr>
                                                    <th scope="row"><?= $row["proizvod_id"] ?></th>
                                                    <!-- <?php if (!empty($row["slika"]) && file_exists("images/" . $row["slika"])) : ?>
                                                        <td class="open-modal" data-value="<?= $row["naziv"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>images/<?= $row["slika"] ?>">
                                                            <img class="barcode img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>images/<?= $row["slika"] ?>" alt="Nema slike">
                                                        </td>
                                                    <?php else : ?>
                                                        <td>
                                                            <img class="barcode img-thumbnail img-fluid" alt="Nema slike">
                                                        </td>
                                                    <?php endif; ?> -->
                                                    <td class="fw-bold"><?= $row["naziv"] ?></td>
                                                    <td><?= $row["ucionica"] ?></td>
                                                    <td><?= $row["kolicina"] ?></td>
                                                    <td class="font-monospace barcode open-modal" data-value="<?= $row["barkod"] ?>" data-image="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.svg"><img style="background-color: white;" class="img-thumbnail img-fluid" src="<?php echo DS . APPFOLDER . DS ?>barcodes/code_<?php echo $row["barkod"] ?>.png" alt="barcode alt"><?= $row["barkod"] ?></td>
                                                </tr>

                                        <?php }
                                        } else {
                                            echo "<th>Još nema zabilježenih stanja</th>";
                                        }
                                        ?>
                                        </tbody>
                                </table>
                            </div>
                        </form>

                    </div>
            </div>
        </main>

    </div>

    <!-- bootstrap modal -->
    <div class="modal fade" id="barcode-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <img style="background-color: white;" id="modal-image" class="img-thumbnail img-fluid" alt="barcode alt">
                <p id="modal-text" class="text-center display-5 font-monospace"></p>
            </div>
        </div>
    </div>


    <script>
        // tooltip aktivacija za bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function odbaciPromjenu(el, proizvodId, staraUcionica, novaUcionica) {

        }

        function prihvatiPromjenu(el, proizvodId, staraUcionica, novaUcionica) { // proizvodId, ..., ..., kolicina
            console.log(proizvodId + ": " + staraUcionica + " -> " + novaUcionica);
            promjenaStanja(proizvodId, staraUcionica, novaUcionica);

            var element = $(el);
            var td = element.parent();
            element.toggle();
            // td.text("PRIHVAĆENO");
            td.removeClass("text-warning").addClass("text-success");
        }

        function clearSearch(el) {
            var element = $(el);
            console.log('#' + element.data('target'))
            $('#' + element.data('target')).val('');
            $('#filter-form').submit();
        }

        function updateInventura() {
            $('#i-input').val(<?php echo $zadnja_inventura ?>);
            $('#filter-form').submit();
        }

        $(document).ready(function() {
            $("#oznaci").click(function() {
                $(".checkEvidencija").each(function() {
                    this.checked = true;
                })
            });

            $('[data-tooltip]').each(function() {
                $(this).tooltip({
                    placement: 'top',
                    title: $(this).data('tooltip')
                });
            })

            $("#i-input").change(function() {
                var inventura_id = $(this).val();
                $('#filter-form').submit();
            });

            $("#makni").click(function() {
                $(".checkEvidencija").each(function() {
                    this.checked = false;
                })
            });

            $('.open-modal').click(function() {
                var imageSrc = $(this).data('image');
                var codeValue = $(this).data('value')
                $('#modal-image').attr('src', imageSrc);
                $('#modal-text').text(codeValue);
                $('#barcode-modal').modal('show');
            });

            $('#refresh').click(() => {
                location.reload();
            });

            $("#filter-form").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serializeArray();

                formData = formData.filter(function(item) {
                    return item.value.trim() !== '';
                });

                var url = '?' + $.param(formData);

                window.location.href = url;
            });

        });
    </script>

</body>

</html>