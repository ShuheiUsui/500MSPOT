$(document).on('click', 'a[data-action="good"]', function(event){
	var form = document.forms.comment_form;

	$.ajax({
		url:'/GitHub/500MSPOT/Articles/Good/',
		type:'POST',
		data:{
			article_id: form.article_id.value
		},
	})
	.done(function (response) {
		console.log('ajax成功');
		console.log(response);
		//再読み込み？
		location.reload();
	})
	.fail(function () {
		console.log('ajax失敗');
		$('#err').html(errorHandler(arguments));
	});
});

$(document).on('click', 'button[data-action="comment_submit"]', function(event){
	var form = document.forms.comment_form;

	$.ajax({
		url:'/GitHub/500MSPOT/Articles/Comment/',
		type:'POST',
		data:{
			article_id: form.article_id.value,
			comment: form.comment.value
		},
	})
	.done(function (response) {
		console.log('ajax成功');
		console.log(response);
		//再読み込み？
		location.reload();
	})
	.fail(function () {
		// console.log('ajax失敗');
		// $('#err').html(errorHandler(arguments));
	});
});

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
