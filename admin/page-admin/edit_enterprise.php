<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/amonecenter/core/init.php';
/*
 for display full info. and edit data
 */
//
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);

    $db = DB::getInstance();
    $db->joinget('id', $id);

        if ($db->count()) {
          $datas = $db->results();
          foreach ($datas as $data) {}
        }

    }//end while
?>
<form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Information</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="entid">ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="entid" name="entid" value="<?php echo $data->ent_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="entname"> የኢንተርፕራይዙ ስም</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="entname" name="entname" value="<?php echo $data->entname;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="Glevel"> የዕድገት ደረጃ</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="Glevel" name="Glevel" value="<?php echo $data->ent_growth_level;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="zerif">የተሰማራበት ዘርፍ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="zerif" name="zerif" value="<?php echo $data->zerif_name;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="workarea">የተሰማራት የሥራ መስክ</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="workarea" name="workarea" value="<?php echo $data->ent_mesk;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="curentcaptal">ወቅታዊ ጠቅላላ ሃብት መጠን  </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="curentcaptal" name="curentcaptal" value="<?php echo $data->curent_capetal;?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href=""><button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button> </a>
                <button type="submit" class="btn btn-primary" name="btnEdit">Save</button>
            </div>
        </div>
    </form>
