<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= $judul ?></h3>
                </div>
                <div class="card-body">
                    <form method="<?= $metod ?>" action="<?= $aktion ?>" enctype="<?= $enctype ?>">
                        <?php
                            foreach($forms as $ls){
                                if($ls[0] == "submit"){
                                ?>
                                <div class="form-group">
                                    <input type="<?= $ls[0] ?>" name="<?= $ls[1] ?>" class="btn btn-primary" value="<?= $ls[2] ?>">
                                </div>
                                <?php
                                } else if($ls[0] == "select"){
                                ?>
                                <div class="form-group">
                                    <label><?= $ls[4] ?></label>
                                    <select class="form-control select2" name="<?= $ls[1] ?>" style="width: 100%;" <?= $ls[6] ?>>
                                        <?php foreach($ls[5] as $opt){
                                            $pc_opt = explode("#",$opt);
                                            if(empty($pc_opt[2])){
                                                $slek = "";
                                            } else {
                                                $slek = "selected";
                                            }
                                        ?>
                                        <option <?= $slek ?> value="<?= $pc_opt[0] ?>"><?= $pc_opt[1] ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <?php
                                } else if($ls[0] == "checkbox") {
                                ?>
                                <div class="form-group">
                                    <p><b><?= $ls[4] ?></b></p>
                                    <?php foreach($ls[5] as $opt){
                                        $pc_opt = explode("#",$opt);
                                    ?>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" name="<?= $ls[1] ?>" value="<?= $pc_opt[0] ?>" type="checkbox" <?= $ls[6] ?>>
                                        <label class="form-check-label"><?= $pc_opt[1] ?></label>
                                    </div>
                                    
                                    <?php } ?>
                                </div>
                                <?php
                                } else if($ls[0] == "textarea") {
                                ?>
                                <div class="form-group">
                                  <label><?= $ls[4] ?></label>
                                  <textarea class="form-control" name="<?= $ls[1] ?>" <?= $ls[6] ?>><?= $ls[2] ?></textarea>
                                </div>
                                <?php
                                } else if($ls[0] == "div") {
                                ?>
                                <div <?= $ls[1] ?>></div>
                                <?php
                                } else if($ls[0] == "hidden") {
                                ?>
                                <input type="<?= $ls[0] ?>" name="<?= $ls[1] ?>" value="<?= $ls[2] ?>" <?= $ls[6] ?>>
                                <?php
                                } else {
                                ?>
                                <div class="form-group">
                                  <label><?= $ls[4] ?></label>
                                  <input type="<?= $ls[0] ?>" class="form-control" name="<?= $ls[1] ?>" value="<?= $ls[2] ?>" <?= $ls[6] ?>>
                                </div>
                                <?php
                                }
                        ?>
                        <?php
                            }
                        ?>
                    </form>
                </div>
            </div>
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= $judul2 ?></h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <?php foreach($heads as $hd) { ?>
                            <th><?= $hd ?></th>
                            <?php } ?>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nos = 1;
                            $cols = $jml_col - 1;
                            foreach($list as $row){
                            ?>
                            <tr>
                                <?php for($yi = 1; $yi <= $cols; $yi++) { ?>
                                <td><?= $row[$yi] ?></td>
                                <?php } ?>
                                <td>
                                    <?php foreach($aksi as $ak) { ?>
                                    <a style="<?= $ak[0] ?>" class="btn <?= $ak[1] ?> <?= $ak[2] ?>" href="<?= site_url().$ak[3].$row[0] ?>/<?= get_kode_uniks($row[0]) ?>" onclick="<?= $ak[6] ?>"><?= $ak[4] ?> <?= $ak[5] ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php  
                            $nos++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
if(empty($jsy)){
    
} else {
?>
<script src="<?= $jsy ?>"></script>
<?php
}
?>