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
			if( $ac < "1" || "2" < $ac ) $ac= "1";
			if( $kt < "5" || "7" < $kt ) $kt= "5";
			$prm= $ac.",".$kt;
			$fpx=fopen($fname,"w"); fwrite($fpx,$prm."\n"); fclose($fpx);
			$mesg= "稼働環境を設定しました。";
		}
		else {
			$mesg= "【稼働環境の設定】";
		}
$ac = '1';
$kt = '5';
if( file_exists($fname) ) { // ファイルの確認
	$data= trim( file_get_contents($fname) );
	$prm= explode(",", $data);
	if( count($prm) >= 2 ) {$ac=$prm[0]; $kt=$prm[1];}
}
if( $kt < "5" || "7" < $kt ) $kt= "5";
$act= array("1" => "商用版サイト（default）", "2" => "有償版サイト");
$ktt= array("5" => "5桁～（default）", "6" => "6桁～", "7" => "7桁～");
$acr= zipaddr_radio("level",$ac, $act);
$ktr= zipaddr_radio("keta", $kt, $ktt);
?>

<h2><?php echo $mesg; ?>（zipaddr-jp）</h2>
<form id="zipaddr-conf" method="post" action="">
<table border="0" cellspacing="1" cellpadding="8" summary=" ">
    <tr>
        <td colspan="2" width="90" bgcolor="#f3f3f3">▼郵番DBの稼働環境選択</td>
    </tr>
    <tr >
        <td bgcolor="#f3f3f3">利用サイト<span style="color: #ff0000;">※</span></td>
        <td><?php echo $acr; ?></td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">ガイダンス画面の出力<span style="color: #ff0000;">※</span></td>
        <td><?php echo $ktr; ?></td>
    </tr>
    <tr >
        <td colspan="2">
※郵便番号DBの稼働場所は、次の2系統があります。<br />
商用版サイト： http://zipaddr.com/ 系<br />
有償版サイト： http://zipaddr2.com/ 系<br />
<br />
※有償版のご利用には別途、<a href="https://zipaddr2-com.ssl-xserver.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
※申請をしないと動きません。<br />
        </td>
    </tr>
</table>
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
		add_submenu_page( 'jetpack', __( 'zipaddr Stats' ), __( 'zipaddr Stats' ), 'manage_options', 'zipaddr-stats-display', 'zipaddr_stats_display' );
	} else {
		add_submenu_page('plugins.php', __('zipaddr'), __('zipaddr'), 'manage_options', 'zipaddr-key-config', 'zipaddr_conf');
		add_submenu_page('index.php', __('zipaddr Stats'), __('zipaddr Stats'), 'manage_options', 'zipaddr-stats-display', 'zipaddr_stats_display');
	}
}
add_action( 'admin_menu', 'zipaddr_admin_menu' );
?>
