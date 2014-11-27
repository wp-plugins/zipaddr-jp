<?php
function zipaddr_plugin_action_links( $links, $file ) {
	if( $file == plugin_basename(zipaddr_PATH.'/zipaddr-jp.php') ) {
		$urls= '<a href="'. admin_url('admin.php?page=zipaddr-key-config').'">'.__('Settings').'</a>';
		$array= array( 'Settings' => $urls );
		$links= array_merge($array, $links);
	}
	return $links;
}
add_filter( 'plugin_action_links', 'zipaddr_plugin_action_links', 10, 2 );


function zipaddr_conf() {
	if( !empty($_GET['page']) && $_GET['page'] == 'zipaddr-key-config' ) {
		$fname= zipaddr_FILE1;
		if( isset($_POST['token']) && !empty($_POST['token']) ) {
			$ac= isset($_POST['level'])? $_POST['level']: "";
			$kt= isset($_POST['keta']) ? $_POST['keta'] : "";
			$ta= isset($_POST['tate']) ? $_POST['tate'] : "";
			$yo= isset($_POST['yoko']) ? $_POST['yoko'] : "";
			$pf= isset($_POST['pfon']) ? $_POST['pfon'] : "";
			$sf= isset($_POST['sfon']) ? $_POST['sfon'] : "";
			$fo= isset($_POST['focs']) ? $_POST['focs'] : "";
			if( $ac < "1" || "3" < $ac ) $ac= "1";
			if( $kt < "5" || "7" < $kt ) $kt= "5";
			if( !preg_match("/^[0-9\-]+$/",$ta) ) $ta="";
			if( !preg_match("/^[0-9\-]+$/",$yo) ) $yo="";
			if( !preg_match("/^[0-9\-]+$/",$pf) ) $pf="";
			if( !preg_match("/^[0-9\-]+$/",$sf) ) $sf="";
			$prm= $ac.",".$kt.",".$ta.",".$yo.",".$pf.",".$sf.",".$fo;
			$fpx=fopen($fname,"w"); fwrite($fpx,$prm."\n"); fclose($fpx);
			$mesg= "稼働環境を設定しました。";
		}
		else {
			$mesg= "【稼働環境の設定】";
		}
$ac = '1';
$kt = '5';
$ta = "";
$yo = "";
$pf = "";
$sf = "";
$fo = "";
if( file_exists($fname) ) { // ファイルの確認
	$data= trim( file_get_contents($fname) );
	$prm= explode(",", $data);
	while( count($prm) < 7 ) {$prm[]="";}
	$ac= $prm[0];
	$kt= $prm[1];
	$ta= $prm[2];
	$yo= $prm[3];
	$pf= $prm[4];
	$sf= $prm[5];
	$fo= $prm[6];
}
if( $kt < "5" || "7" < $kt ) $kt= "5";
if( $pf < 12  || 20  < $pf ) $pf= "12";
if( $sf < 12  || 20  < $sf ) $sf= "20";
$act= array("1" => "商用版サイト（default）","2" => "有償版サイト","3" => "御社サイト内で郵便番号簿管理");
$ktt= array("5" => "5桁～（default）", "6" => "6桁～", "7" => "7桁～");
$acr= zipaddr_radio("level",$ac, $act);
$ktr= zipaddr_radio("keta", $kt, $ktt);
?>

<h2><?php echo $mesg; ?>（zipaddr-jp）</h2>
<form id="zipaddr-conf" method="post" action="">
<table border="1" cellspacing="0" cellpadding="8" summary=" ">
    <tr>
        <td colspan="2" width="90" bgcolor="#f3f3f3">▼郵番DBの稼働環境選択（<span style="color: #ff0000;">※</span>：必須）</td>
    </tr>
    <tr >
        <td bgcolor="#f3f3f3">利用サイト<span style="color: #ff0000;">※</span></td>
        <td><?php echo $acr; ?></td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス画面の出力<span style="color: #ff0000;">※</span></td>
        <td><?php echo $ktr; ?></td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス位置の補正</td>
        <td>
縦：<input type="text" name="tate" size="5" maxlength="4" style="ime-mode:disabled;" value="<?php echo $ta; ?>" />　（default: 18）<br />
横：<input type="text" name="yoko" size="5" maxlength="4" style="ime-mode:disabled;" value="<?php echo $yo; ?>" />　（default: 22）
        </td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス画面の文字サイズ</td>
        <td>
PC：<input type="text" name="pfon" size="5" maxlength="4" style="ime-mode:disabled;" value="<?php echo $pf; ?>" />　（default: 12）<br />
SF：<input type="text" name="sfon" size="5" maxlength="4" style="ime-mode:disabled;" value="<?php echo $sf; ?>" />　（default: 20）
        </td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">選択後にフォーカスするid名</td>
        <td><input type="text" name="focs" value="<?php echo $fo; ?>" /></td>
    </tr>
</table>
<br />
▼郵便番号DBの稼働場所は、次の3系統があります。<br />
　商用版サイト： http://zipaddr.com/ 系<br />
　有償版サイト： http://zipaddr2.com/ 系<br />
　御社サイト版： http://zipaddr3.com/ 系<br />
<br />
▼有償版のご利用には別途、<a href="https://zipaddr2-com.ssl-xserver.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
▼御社サイト版のご利用には別途、<a href="https://zipaddr3-com.ssl-xserver.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
　申請をしないと動きません。<br />
<div class="btn-area">
	<ul><li>
		<input type="hidden" name="token" value="1"/>
		<input id="submit" class="button button-primary" type="submit" value="この内容で登録する" name="submit"></input>
	</li></ul>
</div>
</form>
<?php
	}
}
function zipaddr_radio($iname,$selected,$table) {
	$ans= "";
	$n= 0;
	foreach($table as $key => $data) {
		$select= ($key==$selected) ? " checked" : "";
		$n++;
		$ans.= '<label><input name="'.$iname.'" id="'.$iname.'_'.$n.'" type="radio" value="'.$key.'"';
		$ans.= $select." />";
		$ans.= $data."</label><br />\n";
	}
	return $ans;
}

function zipaddr_admin_menu() {
	if ( class_exists( 'Jetpack' ) ) {
		add_action( 'jetpack_admin_menu', 'zipaddr_load_menu');
	} else {
		zipaddr_load_menu();
	}
}
function zipaddr_load_menu() {	
	if ( class_exists( 'Jetpack' ) ) {
		add_submenu_page( 'jetpack', __( 'zipaddr' ), __( 'zipaddr' ), 'manage_options', 'zipaddr-key-config', 'zipaddr_conf' );
	} else {
		add_submenu_page('plugins.php', __('zipaddr'), __('zipaddr'), 'manage_options', 'zipaddr-key-config', 'zipaddr_conf');
	}
}
add_action( 'admin_menu', 'zipaddr_admin_menu' );
?>
