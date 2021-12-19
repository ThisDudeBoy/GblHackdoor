<?php include('isdefault.php') ?>
<?php 



?>
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list"><font color="white">
                                <p>
                                    <div class="input-group md-form form-sm form-2 pl-0">
                                        <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="myInputTextField">
                                    <div class="input-group-append">
                                    </div>
                                    </div>
                                </p>
            
                                    <table id="server_lisst" class="table table-dark" style="width:100%">
        <thead> 
            <tr>
                <th><?php echo $lang["servername"]; ?></th>
                <th><?php echo $lang["ipaddress"]; ?></th>
                <th><?php echo $lang["users"]; ?></th>
                <th>Vendeur</th>
                <?php if(IsVIP($_SESSION['id']) == true){ ?>
                <th style="min-width: 40px!important;">Acheter (35CC)</th>
              <?php }else{ ?>
                <th style="min-width: 40px!important;">Acheter (50CC)</th>
              <?php } ?>
            </tr>
        </thead>

        <tbody id="ilyadesserveurs">
            <?php 
            $selectionserver = Server::GetAllServer();

                        
                    // Print Output
                    foreach($selectionserver as $AfficheServer)
                    {

                    if($AfficheServer['userid'] == 666){

                     $button_buy = '<button onclick="buyServer('.$data['id'].')" type="button" class="btn btn-warning btn-sm"><i class="fas fa-clone"></i>&nbsp;Acheter</button>';
                     
                     if ($AfficheServer['last_update'] + 60 > time())
        {
            $ussr = htmlspecialchars($AfficheServer['server_users']);
        }else{
            $ussr = "<span class='text-danger'>Server Déconnecter</span>";
        }

                     $ip_data = explode(':', $AfficheServer['server_ip']);
                        echo 
                        "
                            <tr>
                                <td><b>" . htmlspecialchars($AfficheServer['server_name']) . "</b></td>
                                <td><b>" . htmlspecialchars($ip_data[0]) . "</b></td>
                                <td><b>" . $ussr . "</b></td>
                                <td><b>" . Account::GetUser($AfficheServer['last_userid'])['username'] . "</b></td>
                                <td><b>" . $button_buy . " </b></td>
                            </tr>
                        ";
                        } 
                    }
            ?>
        </tbody>
    </table>
</font>
<div class="dataTables_paginate paging_simple_numbers" id="server_lisst_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="server_lisst_previous"><a href="#" style="background-color: #152036; border-color: #253454;" aria-controls="server_lisst" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button next disabled" id="server_lisst_next"><a href="#" aria-controls="server_lisst" data-dt-idx="1" style="background-color: #152036; border-color: #253454;" tabindex="0">Next</a></li></ul></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2019 <a href="https://colorlib.com/wp/templates/">G(bl)Hackdoor</a> All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('isdefault_down.php') ?>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/datatables.bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script>
  $('#server_lisst').dataTable( {
    "iDisplayLength": 999999999,
    "bLengthChange": false,
    "oLanguage": {
        "sSearch": '<span>Recherche: </span>',
        "emptyTable": '<span>¯\_(ツ)_/¯ Pas de serveur ¯\_(ツ)_/¯</span>'
    }
  } );
    oTable = $('#server_lisst').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
$('#myInputTextField').keyup(function(){
      oTable.search($(this).val()).draw() ;
})
    setInterval('load_servers()', 14000);
   function load_servers() {
     $('#ilyadesserveurs').load('listed_ki_tue.php?theget=3');
   }
</script>
<script>
function buyServer(id)
{
    $.ajax({
      url: "core/ajax/buy-server.php?id=" + id
    })
}
</script>
</html>
