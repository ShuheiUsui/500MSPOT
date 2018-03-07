var map = '';

//初期値 (新宿駅)
var pos = {
	'lat':0,
	'lng':0
};

//ピンを立てるSPOT(JSON)
var features = [];

// makerObject
var maker = '';

// var spots = '';

var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

// 現在地取得
// 対応している場合
if( navigator.geolocation ){
	// 現在地を取得
	// 非同期呼び出し
	navigator.geolocation.getCurrentPosition(
		// [第1引数] 取得に成功した場合の関数
		function( position )
		{
			// 取得したデータの整理
			var data = position.coords ;

			this.initMap(data.latitude, data.longitude);

			var neaeSpots = this.nearSpot(data.latitude, data.longitude);

			console.log(data.latitude, data.longitude);

			this.makerStand(neaeSpots);
		},
		// [第2引数] 取得に失敗した場合の関数
		function( error )
		{
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
			console.log(errorMessage) ;
		} ,
		// [第3引数] オプション
		{
			"enableHighAccuracy": false,
			"timeout": 8000,
			"maximumAge": 2000,
		}
	);
}else{
	// 対応していない場合
	// エラーメッセージ
	var errorMessage = "お使いの端末は、GeoLacation APIに対応していません。" ;

	// アラート表示
	alert( errorMessage ) ;

	// HTMLに書き出し
	document.getElementById( 'result' ).innerHTML = errorMessage ;
}

function initMap(lat, lng) {
	this.map = new google.maps.Map(
		document.getElementById('map'), {
			center:{'lat':lat,'lng':lng},
			zoom:16
		}
	);

	// 現在地取得
	var infoWindow = new google.maps.InfoWindow({map:this.map});
	this.pos = {
		'lat':this.pos.lat,
		'lng':this.pos.lng,
	};

	var marker = new google.maps.Marker({
		position: map.getCenter(),
		map: map,
		icon: '/Spot/img/center_icon.png'
	});
}

// マーカーを立てる
function makerStand(spots){

	spots.forEach(function(a) {
		// console.log(a);
		// jsonのままだとformatError(?)が出るので実数型へ変換。
		var marker = new google.maps.Marker({
			position: {lat: parseFloat(a.lat), lng: parseFloat(a.lng)},
			map: this.map
		});

		var infowindow = new google.maps.InfoWindow({
			content: '<div class="spot" style="display:flex;margin-top:10px;"><p><img src="img/articles/'+a.id+'.jpg" style="height:150px;"></p><div class="wrapper" style="padding:5px;"><p class="user_name">'+a.users.name+'</p><p class="good">いいね！'+a.good+'件</p><p class="text-right">'+formatDate(new Date(a.datetime))+'</p></div></div>'
		});

		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});

		console.log(maker);
	});
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	console.log("error");
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ? 'Error:The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
}

//ajax:周辺のスポットを取得
function nearSpot(latitude,longitude) {
	var sp = [];
	$.ajax({
		url:'/Spot/Map/Near',
		type:'POST',
		async: false,
		data:{
			lat:latitude,
			lng:longitude
		},
	})
	.done(function (response) {

		var spots = $.parseJSON(response);
		var flg = false;

		spots.forEach(function(a){
			sp.push(a);
		});
	})
	.fail(function () {
		console.log('ajax失敗');
		$('#err').html(errorHandler(arguments));
		// $('body').html('失敗：'+errorHandler(arguments));
	});
	return sp;
}

/* エラー文字列の生成 */
function errorHandler(args) {
	var error;
	// errorThrownはHTTP通信に成功したときだけ空文字列以外の値が定義される
	if (args[2]) {
		try {
			// JSONとしてパースが成功し、且つ {"error":"..."} という構造であったとき
			// (undefinedが代入されるのを防ぐためにtoStringメソッドを使用)
			error = JSON.parse(args[0].responseText).error.toString();
		} catch (e) {
			// パースに失敗した、もしくは期待する構造でなかったとき
			// (PHP側にエラーがあったときにもデバッグしやすいようにレスポンスをテキストとして返す)
			error = 'parsererror(' + args[2] + '):' + args[0].responseText;
		}
	} else {
		// 通信に失敗したとき
		error = args[1] + '(HTTP request failed)';
	}
	return error;
}

/**
* 日付をフォーマットする
* @param  {Date}   date     日付
* @param  {String} [format] フォーマット
* @return {String}          フォーマット済み日付
*/
var formatDate = function (date, format) {
	if (!format) format = 'YYYY-MM-DD';
	format = format.replace(/YYYY/g, date.getFullYear());
	format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
	format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
	if (format.match(/S/g)) {
		var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
		var length = format.match(/S/g).length;
		for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
	}
	return format;
};

// 絞り込み検索
$('.button').on('click', 'a[data-action="search"]', function(event){
	if(navigator.geolocation){
		var latitude = 0;
		var longitude = 0;
		var sp = [];
		var form = document.forms.search;

		var result = navigator.geolocation.getCurrentPosition(
			function( position ){
				var data = position.coords;

				latitude = data.latitude;
				longitude = data.longitude;

				this.initMap(data.latitude, data.longitude);

				$.ajax({
					url:'/Spot/Map/Search',
					type:'POST',
					data:{
						lat: latitude,
						lng: longitude,
						tag: form.tag.value,
						category: form.category.value,
						length: form.length.value,
						postingDate: form.postingDate.value
					},
				})
				.done(function (response) {
					console.log(response);

					spots = $.parseJSON(response);
					makerStand(spots);
				})
				.fail(function () {
					console.log('ajax失敗');
					$('#err').html(errorHandler(arguments));
				}); // ajax
			},
			function(){
				console.log('error');
			},
			{
				timeout: 600000
			}
		); // getCurrentPosition();
	} // if()
});
