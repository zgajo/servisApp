


<?php
if ($handle = opendir('upload/'. $_GET['primka'] . '/' )) {
    $files = array();
    while (false !== ($file = readdir($handle))) {
        if (($file != ".") && ($file != "..")) {
            $files[] = $file;
        }
    }


    sort($files);
    $thelist = '';
    foreach ($files as $file) {
        $mod = @filemtime("upload/". $_GET['primka'] . '/' .$file);

        $thelist .= '<tr>'
                . '<td>'
                . '<a href="upload/'. $_GET['primka'] . '/'  . $file . '"  target="_blank">' . $file . '</a>'
                . '</td>'
                . '<td>' . pathinfo("upload/". $_GET['primka'] . '/' .$file , PATHINFO_EXTENSION) . '</td>'
                . '<td>' . date("d. m. Y H:i:s.", $mod) . '</td>'
                . '</tr>';
    }

    closedir($handle);
}
?>

<div class="col-md-6" style="clear: both">
       

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Datoteke povezane sa primkom</h3>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <thead>
                <th>Datoteka</th>
                <th>Ekstenzija</th>
                <th>Datum prijenosa</th>
                </thead>
                <tbody>
                    <?= $thelist ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>
    
    <div class="box" style="padding: 5px;">
        <form class="form-group" action="" method="post" enctype="multipart/form-data">
            <label for="uploadFile">Odabrane datoteke: </label>
            <input type="file" id="uploadFile" name="files[]"  style="display: inline-block" multiple>
            <input type="submit" id="submit" style="display: inline-block; margin-left: 15px" value="Upload!">
            <p class="help-block">Dopušteni formati: 'jpg', 'pdf', 'jpeg', 'png', 'txt', 'xls', 'doc', 'docx', 'xlsx'</p>
        </form>    
    </div> 
</div>

<?php
if (!empty($_FILES['files']['name'][0])) {

    $files = $_FILES['files'];
    $uploaded = array();
    $failed = array();

    $allowed = array('jpg', 'pdf', 'jpeg', 'png', 'txt', 'xls', 'doc', 'docx', 'xlsx');

    foreach ($files['name'] as $position => $file_name) {

        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if (in_array($file_ext, $allowed)) {

            if ($file_error === 0) {

                if ($file_size <= 2097152) {


                    if (!file_exists('upload/'. $_GET['primka'])) {
                            mkdir('upload/'. $_GET['primka'], 0777, true);
                        }
                    $file_destination = 'upload/'. $_GET['primka'] . '/' . $file_name;

                    if (move_uploaded_file($file_tmp, $file_destination)) {
                        $uploaded[$position] = 'Uspješno prenesena datoteka '.$file_destination;
                    } else {
                        $failed[$position] = "[$file_name] failed to upload.";
                    }
                } else {
                    $failed[$position] = "Datoteka [$file_name] je prevelika.";
                }
            } else {
                $failed[$position] = "[$file_name] nije uspješno prenesen.";
            }
        } else {
            $failed[$position] = "[{$file_name}] ekstenzija '{$file_ext}' nije dozvoljena.";
        }
    }


    if (!empty($uploaded)) {
        echo '<p>' . print_r($uploaded) . '</p>';
        
    }

    if (!empty($failed)) {
        echo '<p>' . print_r($failed) . '</p>';
    }
   ?>
<script type="text/javascript">
    var primka = <?php echo $_GET['primka'] ?>;
    window.location = 'pregled.php?primka='+primka;
</script>
<?php
   

}
?>