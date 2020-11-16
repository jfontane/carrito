<?php
include("image.php");
$id = isset($_POST['upload_pic_id'])?$_POST['upload_pic_id']:false;
if(!empty($_FILES['images']) && $id){
    // File upload configuration
    $targetDir = "../images/";
    $allowTypes = array('jpg','png','jpeg','gif');

    $images_arr = array();
    $nombres_images_arr = array();
    $band=true;
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];
        // File upload path
        $fileName = $id.'_'.basename($_FILES['images']['name'][$key]);
        $fileName_xs = substr($fileName, 0, strlen($fileName)-4).'_xs'.substr($fileName, strlen($fileName)-4,4);
        $fileName_md = substr($fileName, 0, strlen($fileName)-4).'_md'.substr($fileName, strlen($fileName)-4,4);
        $fileName_lg = substr($fileName, 0, strlen($fileName)-4).'_lg'.substr($fileName, strlen($fileName)-4,4);

        $targetFilePath = $targetDir.$fileName;

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            // Store images on the server
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],'../'.$targetFilePath)){
                $images_arr[] = $targetFilePath;
                //if ($band) {
                   crearThumbnail('../'.$targetFilePath, '../images/zoomengine/'.$fileName_lg, 768, 1024);
                   crearThumbnail('../'.$targetFilePath, '../images/zoomengine/'.$fileName_md, 240, 320);
                  //$band=false;
                //}
                crearThumbnail('../'.$targetFilePath, '../images/'.$fileName_xs, 48, 64);
                crearThumbnail('../'.$targetFilePath, '../images/'.$fileName_md, 240, 320);
                crearThumbnail('../'.$targetFilePath, '../images/'.$fileName_lg, 768, 1024);
                $nombres_images_arr[] = $fileName;
            }
        }
    };

    $dc2array = serialize($nombres_images_arr);

    $sql_update="UPDATE articulos SET url_image='".$dc2array."' WHERE id=".$id;
    include ("../php/conexion.php");
    $query = $db->query($sql_update);
    // Generate gallery view of the images
    if(!empty($images_arr)){ ?>
        <ul>
        <?php foreach($images_arr as $image_src){ ?>
            <li><img src="../<?php echo $image_src; ?>" alt="" width="180"></li>
        <?php } ?>
        </ul>
    <?php }
}
?>
