<?php
if ($phpVersion >= "5") { 
include ('../includes/beerXMLparser/input_beer_xml.inc.php');

//Mmaximum file size.
$MAX_SIZE = 2000000;

//Allowable file Mime Types.
$FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png','application/msword');

//Allowable file ext. names.
$FILE_EXTS  = array('.xml','.txt');

//Allow file delete? no, if only allow upload only
$DELETABLE  = false;

$recipeList = "";
function formatInsertedRecipes($recipes) {
    foreach($recipes as $id=>$name){
        $recipelist .= "<tr><td><a href=\"index.php?action=edit&dbTable=recipes&id=" .$id . "\">".$name."</a></td></tr>";
    }
    return $recipelist;
}

//$site_name = $_SERVER['HTTP_HOST'];
//$url_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$url_this =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

if(!$_REQUEST['inserted'] == "true") $_SESSION['recipes'] = "";
if ($_FILES['userfile']) {
  	$file_type = $_FILES['userfile']['type'];
  	$file_name = $_FILES['userfile']['name'];
  	$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
    $message = $_FILES['userfile']['tmp_name'];
  //File Size Check
  if ($_FILES['userfile']['size'] > $MAX_SIZE) 
    $message = "The file size is over 2MB.  Please adjust the size and try again.";
  //File Type/Extension Check
  else if (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS))
    $message = "Sorry, that file type is not allowed to be uploaded.  Acceptable file type extensions are: .xml, .txt";
  else if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
    $input = new InputBeerXML($_FILES['userfile']['tmp_name']);
    if ($_POST["insert_type"] == "recipes"){
        $insertedRecipes = $input->insertRecipes();
        $recipes = '';
        foreach($insertedRecipes as $id=>$name){
            $recipes .= "<tr><td>".$name." [<a href=\"index.php?action=edit&dbTable=recipes&id=".$id."\">Edit</a>]</td></tr>";
        }
        $message = count($insertedRecipes) . " ". $row_pref['menuRecipes']. " Inserted";
    } else if($_POST["insert_type"] == "brewBlog"){
        $insertedRecipes = $input->insertBlogs();
        $recipes = '';
        foreach($insertedRecipes as $id=>$name){
            $recipes .= "<tr><td>".$name." [<a href=\"index.php?action=edit&dbTable=brewing&id=" .$id . "\">Edit</a>]</td></tr>";
        }
        $message = count($insertedRecipes) . " " .$row_pref['menuBrewBlogs']. " Inserted";
    }
    $_SESSION['recipes'] = $recipes;
   }

   print "<script>window.location.href='index.php?action=importXML&section=".$section."&message=". htmlentities($message) . "&inserted=true'</script>";
}
else if (!$_FILES['userfile']) $message = "userfile check failed";
else
	$message = "Invalid file type. Must be an .xml or .txt file.";

?>
<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; Import Beer XML to <?php echo $dbName; ?></div>
<div id="subtitleAdmin">Import Beer XML to <?php echo $dbName; ?></div>
<?php // $d = "02/28/2009"; echo datecharcheck($d); ?>
<form name="upload" id="upload" ENCTYPE="multipart/form-data" method="post">
<table class="dataTable">
<tr>
	<td colspan="2"><p>Please note that any mash profiles, water profiles, and equipment profiles <strong><em>will not be imported</em></strong>. After import, click <em>Edit</em><?php if ($dbTable == "brewing") { ?> to add mash, water, and equipment information<?php } ?> for each <?php echo $msgName; ?> listed to check values and customize further.</p></td>
<tr>
	<td class="dataLabelLeft">Beer XML File:</td>
    <td class="data"><input name="userfile" type="file" class="texta" id="userfile" size="60"></td>
</tr>
<tr>
	<td class="dataLabelLeft">Import Into:</td>
    <td class="data">
    <input name="insert_type" type="radio" class="radiobutton" value="recipes" <?php if ($dbTable == "recipes") echo "checked"; ?>><span class="data"><?php echo $row_pref['menuRecipes']; ?></span><br />
	<input name="insert_type" type="radio" class="radiobutton" value="brewBlog" <?php if ($dbTable == "brewing") echo "checked"; ?>><span class="data"><?php echo $row_pref['menuBrewBlogs']; ?></span></td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td class="data"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_upload_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Upload" class="radiobutton" value="Upload"></td>
</tr>
<tr>
	<td colspan="2" class="error"><br><?=$_REQUEST[message]; ?><br></td>
</tr>
</table>
</form>
<?php if ($dbTable == "default") { ?>
<div id="headerContentAdmin">Imported Files</div>
<table class="dataTable text_11">
<?=$_SESSION['recipes']; ?>
</tr>
</table>
<?php } 
} else { ?>
<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; Import Beer XML File</div>
<div id="subtitleAdmin">Import Beer XML File</div>
<p>Your server's version of PHP does not support the BeerXML import feature.  PHP version 5.x is required &mdash; this server is running PHP version <?php echo $phpVersion; ?>.</p>
<br />
<br />
<?php } ?>

