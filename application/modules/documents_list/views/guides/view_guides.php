<div class="text-center">
    <ul class="nav nav-tabs nav-fill nav-success nav-pills mb-3 border-0" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100 active" id="IK-tab" data-toggle="tab" data-target="#IK" type="button" role="tab" aria-controls="IK" aria-selected="true">IK</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="CMC-tab" data-toggle="tab" data-target="#CMC" type="button" role="tab" aria-controls="CMC" aria-selected="false">CMC</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="Template-tab" data-toggle="tab" data-target="#Template" type="button" role="tab" aria-controls="Template" aria-selected="false">Template</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="UBLK-tab" data-toggle="tab" data-target="#UBLK" type="button" role="tab" aria-controls="UBLK" aria-selected="false">UBLK</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="Sertifikat-tab" data-toggle="tab" data-target="#Sertifikat" type="button" role="tab" aria-controls="Sertifikat" aria-selected="false">Format Sertifikat</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="Analisa-tab" data-toggle="tab" data-target="#Analisa" type="button" role="tab" aria-controls="Analisa" aria-selected="false">Analisa Drift</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="SertCalibrator-tab" data-toggle="tab" data-target="#SertCalibrator" type="button" role="tab" aria-controls="SertCalibrator" aria-selected="false">Sertifikat Calibrator</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link font-weight-bolder w-100" id="CekAntara-tab" data-toggle="tab" data-target="#CekAntara" type="button" role="tab" aria-controls="CekAntara" aria-selected="false">Cek Antara</button>
        </li>
    </ul>

    <div class="tab-content ">
        <div class="tab-pane active" id="IK" role="tabpanel" aria-labelledby="IK-tab">
            <div id="accDataIK" role="tablist" aria-multiselectable="true">

                <!-- IK -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[1])) foreach ($ArrDoc[1] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secIK<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataIK" href="#accIK<?= $n ?>" aria-expanded="true" aria-controls="accIK<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accIK<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secIK<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "IK/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="CMC" role="tabpanel" aria-labelledby="CMC-tab">
            <div id="accDataCMC" role="tablist" aria-multiselectable="true">
                <!-- CMC -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[2])) foreach ($ArrDoc[2] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secCMC<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataCMC" href="#accCMC<?= $n ?>" aria-expanded="true" aria-controls="accCMC<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accCMC<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secCMC<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "CMC/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="Template" role="tabpanel" aria-labelledby="Template-tab">
            <div id="accDataTEMP" role="tablist" aria-multiselectable="true">
                <!-- TEMPLATE -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[3])) foreach ($ArrDoc[3] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secTEMP<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataTEMP" href="#accTEMP<?= $n ?>" aria-expanded="true" aria-controls="accTEMP<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accTEMP<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secTEMP<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "TEMPLATE/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="UBLK" role="tabpanel" aria-labelledby="UBLK-tab">
            <div id="accDataUBLK" role="tablist" aria-multiselectable="true">
                <!-- UBLK -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[4])) foreach ($ArrDoc[4] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secUBLK<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataUBLK" href="#accUBLK<?= $n ?>" aria-expanded="true" aria-controls="accUBLK<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accUBLK<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secUBLK<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "UBLK/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="Sertifikat" role="tabpanel" aria-labelledby="Sertifikat-tab">
            <div id="accDataSERT" role="tablist" aria-multiselectable="true">
                <!-- SERTIFIKAT -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[5])) foreach ($ArrDoc[5] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secSERT<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataSERT" href="#accSERT<?= $n ?>" aria-expanded="true" aria-controls="accSERT<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accSERT<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secSERT<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "FORMAT_SERTIFIKAT/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="Analisa" role="tabpanel" aria-labelledby="Analisa-tab">
            <div id="accDataANALISA" role="tablist" aria-multiselectable="true">
                <!-- ANALISA -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[6])) foreach ($ArrDoc[6] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secANALISA<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataANALISA" href="#accANALISA<?= $n ?>" aria-expanded="true" aria-controls="accANALISA<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accANALISA<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secANALISA<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "ANALISA_DRIFT/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="SertCalibrator" role="tabpanel" aria-labelledby="SertCalibrator-tab">
            <div id="accDataCALIBRATOR" role="tablist" aria-multiselectable="true">
                <!-- CALIBRATOR -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[7])) foreach ($ArrDoc[7] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secCALIBRATOR<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataCALIBRATOR" href="#accCALIBRATOR<?= $n ?>" aria-expanded="true" aria-controls="accCALIBRATOR<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accCALIBRATOR<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secCALIBRATOR<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "SERTIFIKAT_KALIBRATOR/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="CekAntara" role="tabpanel" aria-labelledby="CekAntara-tab">
            <div id="accDataCEK_ANTARA" role="tablist" aria-multiselectable="true">
                <!-- CEK_ANTARA -->
                <div class="card border-0 mb-3" style="border-radius: 5px;">
                    <?php
                    $n = 0;
                    if (isset($ArrDoc[8])) foreach ($ArrDoc[8] as $d1): $n++; ?>
                        <div class="card-header bg-light border-0 py-4 mb-2 cursor-pointer" role="tab" id="secCEK_ANTARA<?= $n ?>" style="border-radius: 5px;">
                            <h4 class="mb-0 font-weight-bolder" data-toggle="collapse" data-parent="#accDataCEK_ANTARA" href="#accCEK_ANTARA<?= $n ?>" aria-expanded="true" aria-controls="accCEK_ANTARA<?= $n ?>">
                                <?= $n . ". " . $d1->name; ?>
                            </h4>
                        </div>

                        <div id="accCEK_ANTARA<?= $n ?>" class="collapse in" role="tabpanel" aria-labelledby="secCEK_ANTARA<?= $n ?>">
                            <div style="width:92%;;background-color: red;position: absolute;opacity: 0;"></div>
                            <iframe style="pointer-events:visibleStroke;" onclick="false" oncontextmenu="false" src="<?= base_url() . $file . "CEK_ANTARA/" . $d1->file; ?> #toolbar=0&navpanes=0" frameborder="1" width="100%" height="500"></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>


</div>