<?php
namespace App\Utils;
use Cake\ORM\TableRegistry;
use App\Model\Entity\User;

/**
 * DataAccessObject
 * @author Shuhei Usui
 */
class Auth
{
	private $userTable;

	

	function __construct(){
		// session状態の確認
		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	/*
	 *	アカウント認証
	 * @return boolean
	 *	['flg'] loginフラグ
	 *	['miss'] password不一致
	 *	['empty'] address不一致
	 *	['authority'] 1:user, 2:admin
	*/
	public function userAuth($address, $password){
		$auth = array(
			'flg' => false,
			'empty' => false,
			'miss' => false,
			'authority' => 1
		);

		$this->userTable = TableRegistry::get('Users');

		// usersテーブルからメールアドレスが一致したものを取得
		$user = $this->userTable->find()->where(['mailAddress =' => $address]);

		foreach ($user as $row) {
			if($row['password'] == hash('sha256',$password)){
				// アドレス登録 = true
				$auth['flg'] = true;

				// ユーザ情報をsessionに追加
				$_SESSION['userInfo'] = array(
					'id' => $row['id'],
					'name' => $row['name']
				);
			}else if(!empty($row)){
				// パスワード確認 = false
				$auth['miss'] = true;
			}
		}
		// アカウント確認 = false
		if(!$auth['flg'] && !$auth['miss']){
			$auth['empty'] = true;
		}

		return $auth;
	}

	// login状態の確認
	public function checkLogin(){
		$flg = false;

		if(isset($_SESSION['userInfo'])){
			// sessionの正当性確認
			$flg = true;
		}
		return $flg;
	}

	public function getUserInfo(){
		$userInfo = $_SESSION['userInfo'];
		return $userInfo;
	}

	// logout
	public function eraseSession(){
		$_SESSION = array();

		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		session_destroy();
	}

}
