var now = {
	'lat': 0,
	'lng': 0
}

var form = document.forms.post_form;


// 対応している場合
if( navigator.geolocation ){
	// 現在地を取得
	navigator.geolocation.getCurrentPosition(
		// [第1引数] 取得に成功した場合の関数
		function( position ){
			// 取得したデータの整理
			document.getElementById('map').innerHTML = 'getCurrentPosition:成功';
			var data = position.coords ;

			// データの整理
			this.now.lat = data.latitude;
 			this.now.lng = data.longitude;

			this.form.lat.value = data.latitude;
			this.form.lng.value = data.longitude;

			this.initMap();
			// アラート表示
			console.log( "あなたの現在位置は、\n[" + this.now.lat + "," + this.now.lng + "]\nです。" ) ;
		},

		// [第2引数] 取得に失敗した場合の関数
		function( error ){
			document.getElementById('map').innerHTML = 'getCurrentPosition:失敗';
			// エラーコード(error.code)の番号
			// 0:UNKNOWN_ERROR				原因不明のエラー
			// 1:PERMISSION_DENIED			利用者が位置情報の取得を許可しなかった
			// 2:POSITION_UNAVAILABLE		電波状況などで位置情報が取得できなかった
			// 3:TIMEOUT					位置情報の取得に時間がかかり過ぎた…

			// エラー番号に対応したメッセージ
			var errorInfo = [
				"原因不明のエラーが発生しました…。" ,
				"位置情報の取得が許可されませんでした…。" ,
				"電波状況などで位置情報が取得できませんでした…。" ,
				"位置情報の取得に時間がかかり過ぎてタイムアウトしました…。"
			] ;

			// エラー番号
			var errorNo = error.code ;

			// エラーメッセージ
			var errorMessage = "[エラー番号: " + errorNo + "]\n" + errorInfo[ errorNo ] ;

			// アラート表示
			alert(errorMessage) ;
		} ,

		// [第3引数] オプション
		{
			"enableHighAccuracy": false,
			"timeout": 8000,
			"maximumAge": 2000,
		}

	) ;
}
// 対応していない場合
else{
	// エラーメッセージ
	var errorMessage = "お使いの端末は、GeoLacation APIに対応していません。" ;

	// アラート表示
	alert( errorMessage ) ;

	// HTMLに書き出し
	document.getElementById('map').innerHTML = '少々お待ちください...。';
	document.getElementById('map').innerHTML = errorMessage;
}


// GoogleMap
function initMap() {
	var map = new google.maps.Map(
	document.getElementById('map'), {
		center:this.now,
		zoom:16
	}
	);
	var marker = new google.maps.Marker({
		position: this.now,
		map: map,
		title:"Hello!"
	});
}

//uploadFileをcanvasに描画
$("#image").change(function() {
	document.getElementById('canvas_wrap').innerHTML = '<canvas id="canvas" style="max-width:100%;"></canvas>';

	var file = this.files[0];
	if (!file.type.match(/^image\/(png|jpeg|gif)$/)) return;

	var image = new Image();
	var reader = new FileReader();

	reader.onload = function(evt) {
		image.onload = function() {
			$("#canvas").attr("width",image.width);
			$("#canvas").attr("height",image.height);

			var canvas = $("#canvas");
			var ctx = canvas[0].getContext("2d");
			ctx.drawImage(image, 0, 0); //canvasに画像を転写
		}
		image.src = evt.target.result;
	}
	reader.readAsDataURL(file);
});
