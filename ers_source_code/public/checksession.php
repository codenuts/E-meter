<?php 
session_start();
print_r( $_SESSION );

echo "<br/>";
 
$text = "PRO1,PRO2,PRO3,PRO4,PRO5";
//var_dump($text);
//echo "<br>";
$ext1 = "rony";
$ext2  = "kader";
$text1 = explode(",", $text);
foreach($text1 as $val){
	echo "INSERT INTO `tablename` VALUES ('', '$val','$ext1','$ext2');<br>";
}
 

 echo "<br/>";

if ( isset( $_POST['submit'])) {
	 
	 echo "<pre>";
	 print_r( $_FILES );
}
 ?>

 <form action="" method="post" enctype="multipart/form-data">
 	<input type="file" name="file">
 	<input type="submit" value="Upload" name="submit">
 </form>
 
<?php
    $mypix = simplexml_load_file('http://api.flickr.com/services/feeds/photoset.gne?set=72157627229375826&nsid=73845487@N00&lang=en-us');

    foreach ($mypix->entry as $pixinfo):
        $title=$pixinfo->title;
        $link=$pixinfo->link['href'];
        $image=str_replace("_b.jpg","_s.jpg",$pixinfo->link[1]['href']);
        echo $link .'**'.$image."\n";
    endforeach;
?>