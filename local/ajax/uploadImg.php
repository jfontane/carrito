<?php
include("image.php");
$id = isset($_POST['upload_pic_id'])?$_POST['upload_pic_id']:false;
if(!empty($_FILES['images']) && $id){
    // File upload configuration
    $targetDir = "../images/";
    $allowTypes = array('jpg','png','jpeg','gif');

    $images_arr = array();
    $nombres_images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];
        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir.$id.'-big-'.$fileName;

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            // Store images on the server
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],'../'.$targetFilePath)){
                $images_arr[] = $targetFilePath;
                $nombres_images_arr[] = $id.'-big-'.$fileName;
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
