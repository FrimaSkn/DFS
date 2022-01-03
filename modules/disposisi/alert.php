<?php 
if(isset($_SESSION['succAdd'])){
    $succAdd = $_SESSION['succAdd'];
    echo '<div id="alert-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-check-circle"></i>'.$succAdd.'</h4>                                      
        </div>';
    unset($_SESSION['succAdd']);
}
if(isset($_SESSION['succEdit'])){
    $succEdit = $_SESSION['succEdit'];
    echo '<div id="alert-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-check-circle"></i>'.$succEdit.'</h4>          
                       
        </div>';
    unset($_SESSION['succEdit']);
}
if(isset($_SESSION['succDel'])){
    $succDel = $_SESSION['succDel'];
    echo '<div id="alert-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-check-circle"></i>'.$succDel.'</h4>
        </div>';
    unset($_SESSION['succDel']);
}
// if(isset($_SESSION['succAdd'])){
//     $succAdd = $_SESSION['succAdd'];
//     echo '<div id="alert-message" class="row">
//             <div class="col m12">
//                 <div class="card green lighten-5">
//                     <div class="card-content notif">
//                         <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succAdd.'</span>
//                     </div>
//                 </div>
//             </div>
//         </div>';
//     unset($_SESSION['succAdd']);
// }
// if(isset($_SESSION['succEdit'])){
//     $succEdit = $_SESSION['succEdit'];
//     echo '<div id="alert-message" class="row">
//             <div class="col m12">
//                 <div class="card green lighten-5">
//                     <div class="card-content notif">
//                         <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succEdit.'</span>
//                     </div>
//                 </div>
//             </div>
//         </div>';
//     unset($_SESSION['succEdit']);
// }
// if(isset($_SESSION['succDel'])){
//     $succDel = $_SESSION['succDel'];
//     echo '<div id="alert-message" class="row">
//             <div class="col m12">
//                 <div class="card green lighten-5">
//                     <div class="card-content notif">
//                         <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succDel.'</span>
//                     </div>
//                 </div>
//             </div>
//         </div>';
//     unset($_SESSION['succDel']);
// }
?>