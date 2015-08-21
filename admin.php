<?php
function zipaddr_plugin_action_links( $links, $file ) {
	if( $file == plugin_basename(zipaddr_PATH.'/zipaddr-jp.php') ) {
		$urls= '<a href="'. admin_url('admin.php?page='.zipaddr_KEYS).'">'.__('Settings').'</a>';
		$array= array( 'Settings' => $urls );
		$links= array_merge($array, $links);
	}
	return $links;
}
function zipaddr_conf() {
	if( !empty($_GET['page']) && $_GET['page'] == zipaddr_KEYS ) {
		$fname= zipaddr_FILE1;
		if( isset($_POST['token']) && !empty($_POST['token']) ) {
			$ac= isset($_POST['level'])? $_POST['level']: "";
			$kt= isset($_POST['keta']) ? $_POST['keta'] : "";
			$ta= isset($_POST['tate']) ? $_POST['tate'] : "";
			$yo= isset($_POST['yoko']) ? $_POST['yoko'] : "";
			$pf= isset($_POST['pfon']) ? $_POST['pfon'] : "";
			$sf= isset($_POST['sfon']) ? $_POST['sfon'] : "";
			$fo= isset($_POST['focs']) ? $_POST['focs'] : "";
			$si= isset($_POST['sysid'])? $_POST['sysid']: "";
			$dl= isset($_POST['deli']) ? $_POST['deli'] : "";
			$pr= isset($_POST['parm']) ? $_POST['parm'] : "";
			if( $ac < "1" || "4" < $ac ) $ac= "1";
			if( $kt < "5" || "7" < $kt ) $kt= "7";
			if( $ac == "4" ) $kt= "7";
			if( !preg_match("/^[0-9\-]+$/",$ta) ) $ta="";
			if( !preg_match("/^[0-9\-]+$/",$yo) ) $yo="";
			if( !preg_match("/^[0-9\-]+$/",$pf) ) $pf="";
			if( !preg_match("/^[0-9\-]+$/",$sf) ) $sf="";
			if( $dl=="" || $dl=="-" ) {;}
			else $dl= "-";
			$si= htmlspecialchars($si);
			$pr= htmlspecialchars($pr);
			$pr= str_replace(",", "|", $pr);
			$prm= $ac.",".$kt.",".$ta.",".$yo.",".$pf.",".$sf.",".$fo.",".trim($si).",".$dl.",".$pr;
			$fpx=fopen($fname,"w"); fwrite($fpx,$prm."\n"); fclose($fpx);
			$mesg= "稼働環境を設定しました。";
		}
		else {
			$mesg= "【稼働環境の設定】";
		}
$ac= '1';
$kt= '7';
$ta= "";
$yo= "";
$pf= "";
$sf= "";
$fo= "";
$si= "";
$dl= "-";
$pr= "";
if( file_exists($fname) ) { // ファイルの確認
	$data= trim( file_get_contents($fname) );
	$prm= explode(",", $data);
	while( count($prm) < 8 ) {$prm[]="";}
	$ac= $prm[0];
	$kt= $prm[1];
	$ta= $prm[2];
	$yo= $prm[3];
	$pf= $prm[4];
	$sf= $prm[5];
	$fo= $prm[6];
	$si= $prm[7];
	$dl= isset($prm[8]) ?  $prm[8] : "-";
	$pr= isset($prm[9]) ?  $prm[9] : "";
}
if( $kt < "5" || "7" < $kt ) $kt= "7";
if( $pf < 12  || 20  < $pf ) $pf= "";
if( $sf < 12  || 20  < $sf ) $sf= "";
$act= array("1" => "商用版サイト（default）","4" => "　〃　　（スピードアップ版）","2" => "有償版サイト","3" => "御社サイト内で郵便番号簿管理");
$ktt= array("5" => "5桁～", "6" => "6桁～", "7" => "7桁～（default）");
$acr= zipaddr_radio("level",$ac, $act);
$ktr= zipaddr_radio("keta", $kt, $ktt);
$pr= str_replace("|", ",", $pr);
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
        <td bgcolor="#f3f3f3">郵便番号の区切り文字</td>
        <td><input type="text" name="deli" size="5" maxlength="1" style="ime-mode:disabled;" value="<?php echo $dl; ?>" />　（default: '-'）</td>
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
    <tr>
        <td bgcolor="#f3f3f3">システム拡張用のAP識別子</td>
        <td><input type="text" name="sysid" value="<?php echo $si; ?>" /></td>
    </tr>
    <tr>
        <td bgcolor="#f3f3f3">オウンコード設定パラメータ</td>
        <td><input type="text" name="parm" value="<?php echo $pr; ?>" /><br />例：bgc=#3366ff,rtrs=</td>
    </tr>
</table>
<br />
▼郵便番号DBの稼働場所は、次の3系統があります。<br />
　商用版サイト： http://zipaddr.com/ 系<br />
　有償版サイト： http://zipaddr2.com/ 系<br />
　御社サイト版： http://zipaddr3.com/ 系<br />
<br />
※有償版は利用申請をしないと動きません。<br />
▼有償版のご利用には別途、<a href="https://zipaddr2-com.ssl-sixcore.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
▼御社サイト版のご利用には別途、<a href="https://zipaddr3-com.ssl-sixcore.jp/use/" target="_blank">利用申請（有償）</a> が必要となります。<br />
▼[システム拡張AP識別子（'_'区切り）]<br />
　例：WooCommerce_TrustForm<br />
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

// 設定メニュー下にサブメニューを追加
function zipaddr_admin_pages(){
	add_options_page('Zipaddr-JP','Zipaddr-JP', 'activate_plugins',zipaddr_KEYS,'zipaddr_admin_page');
}
function zipaddr_admin_page(){
	zipaddr_conf();
}
?>
