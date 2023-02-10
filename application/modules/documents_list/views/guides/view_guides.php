<div class="row">
    <div class="col-6">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td width="150">Nomor</td>
                    <td width="10">:</td>
                    <td width=""><?= $data->number; ?></td>
                </tr>
                <tr>
                    <td>Kelompok</td>
                    <td>:</td>
                    <td><?= $data->guide_detail_name; ?></td>
                </tr>
                <tr>
                    <td>Jenis Alat</td>
                    <td>:</td>
                    <td><?= $data->guide_detail_data_name; ?></td>
                </tr>
                <tr>
                    <td>Rentang Ukur</td>
                    <td>:</td>
                    <td><?= $data->range_measure; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Terbit</td>
                    <td>:</td>
                    <td><?= $data->publish_date; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-6">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>Tanggal Revisi</td>
                    <td>:</td>
                    <td><?= $data->revision_date; ?></td>
                </tr>
                <tr>
                    <td>Nomor Revisi</td>
                    <td>:</td>
                    <td><?= $data->revision_number; ?></td>
                </tr>
                <tr>
                    <td width="150">Metode</td>
                    <td width="10">:</td>
                    <td width=""><?= ($data->methode) ? (($data->methode == 'INS') ? 'Insitu' : 'Inlab') : ''; ?></td>
                </tr>
                <tr>
                    <td>Referensi</td>
                    <td>:</td>
                    <td><?= $data->reference_name; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <label class="col-2 control-label">Document</label>
    <div class="col-8">
        <input type="hidden" name="document" id="document" value="<?= $data->document; ?>">
        <input type="hidden" name="company" id="company" value="<?= $data->company_id; ?>">
        <canvas class="border border-2 rounded-lg" id="pdf-preview" width="150" height="194" style="display: none;">
        </canvas>
        <img height="120" id="no-file" style="display: inline-block;" class="border border-2 rounded-lg" src="<?= base_url(); ?>directory/no-file.png" alt="">
    </div>
</div>
<div class="row">
    <label class="col-2 control-label">Video</label>
    <div class="col-8">

    </div>
</div>


<script>
    $(document).ready(function() {
        const document = $('#document').val()
        const company = $('#company').val()
        const file = siteurl + 'directory/MASTER_GUIDES/' + company + '/' + document;
        // console.log(document)
        // console.log(company)
        // console.log(file)

        var http = new XMLHttpRequest();
        http.open('HEAD', file, false);
        http.send();
        if (http.status != 404) {
            fetch(file)
                .then((res) => res.blob())
                .then((myBlob) => {
                    // console.log(myBlob);
                    // logs: Blob { size: 1024, type: "image/jpeg" }
                    myBlob.name = document;
                    myBlob.lastModified = new Date();
                    // console.log(myBlob instanceof File);
                    // logs: false
                    _OBJECT_URL = URL.createObjectURL(myBlob)
                    // console.log(_OBJECT_URL);
                    showPDF(_OBJECT_URL);
                });
        }
    })

    var _PDF_DOC,
        _CANVAS = document.querySelector('#pdf-preview'),
        _OBJECT_URL;

    function showPDF(pdf_url) {

        PDFJS.getDocument({
            url: pdf_url
        }).then(function(pdf_doc) {
            _PDF_DOC = pdf_doc;

            // Show the first page
            showPage(1);

            // destroy previous object url
            URL.revokeObjectURL(_OBJECT_URL);
        }).catch(function(error) {
            // trigger Cancel on error
            $("#cancel-pdf").click();

            // error reason
            alert(error.message);
        });;
    }

    function showPage(page_no) {
        var _CANVAS = document.querySelector('#pdf-preview');
        // fetch the page
        // console.log(page_no);
        // console.log(_PDF_DOC.getPage(page_no));
        _PDF_DOC.getPage(page_no).then(function(page) {
            // set the scale of viewport
            var scale_required = _CANVAS.width / page.getViewport(1).width;

            // get viewport of the page at required scale
            var viewport = page.getViewport(scale_required);

            // set canvas height
            _CANVAS.height = viewport.height;

            var renderContext = {
                canvasContext: _CANVAS.getContext('2d'),
                viewport: viewport
            };

            // render the page contents in the canvas
            page.render(renderContext).then(function() {
                $("#pdf-preview").css('display', 'inline-block');
                $("#no-file").css('display', 'none');
            });
        });
    }
</script>