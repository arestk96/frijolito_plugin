<?php
function frijolito_hum_on()
{?>
  <input type=submit value='ON' style='width:240px;height:108px;background-color: #84B1FF;color: snow;font-size:18pt;' onClick="location.href='../wp-content/plugins/frijolito-plugin/lib/hson.php'">
  <input type=submit value='OFF' style='width:240px;height:108px;background-color: #84B1FF;color: snow;font-size:18pt;' onClick="location.href='../wp-content/plugins/frijolito-plugin/lib/hsoff.php'">
<?php
}
add_shortcode("sch_frijolito_hum_on",'frijolito_hum_on');
//add_action('templete_redirect')

function tab1()
{
  ?>
  <iframe src="/tabla.php" scrolling="auto"></iframe>
  <?php
}
add_shortcode("sch_frijolito_tab1",'tab1');

function tab2()
{
  ?>
  <iframe src="../wp-content/plugins/frijolito-plugin/lib/tabla2.php" scrolling="auto"></iframe>
  <?php
}
add_shortcode("sch_frijolito_tab2",'tab2');
