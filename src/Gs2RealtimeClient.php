<?php
/*
 Copyright Game Server Services, Inc.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 */

namespace GS2\Realtime;

use GS2\Core\Gs2Credentials as Gs2Credentials;
use GS2\Core\AbstractGs2Client as AbstractGs2Client;
use GS2\Core\Exception\NullPointerException as NullPointerException;

/**
 * GS2-Realtime クライアント
 *
 * @author Game Server Services, inc. <contact@gs2.io>
 * @copyright Game Server Services, Inc.
 *
 */
class Gs2RealtimeClient extends AbstractGs2Client {

	public static $ENDPOINT = 'realtime';
	
	/**
	 * コンストラクタ
	 * 
	 * @param string $region リージョン名
	 * @param Gs2Credentials $credentials 認証情報
	 * @param array $options オプション
	 */
	public function __construct($region, Gs2Credentials $credentials, $options = []) {
		parent::__construct($region, $credentials, $options);
	}
	
	/**
	 * ギャザリングプールリストを取得
	 * 
	 * @param string $pageToken ページトークン
	 * @param integer $limit 取得件数
	 * @return array
	 * * items
	 * 	* array
	 * 		* gatheringPoolId => ギャザリングプールID
	 * 		* ownerId => オーナーID
	 * 		* name => ギャザリングプール名
	 * 		* description => 説明文
	 * 		* createAt => 作成日時
	 * * nextPageToken => 次ページトークン
	 */
	public function describeGatheringPool($pageToken = NULL, $limit = NULL) {
		$query = [];
		if($pageToken) $query['pageToken'] = $pageToken;
		if($limit) $query['limit'] = $limit;
		return $this->doGet(
					'Gs2Realtime', 
					'DescribeGatheringPool', 
					Gs2RealtimeClient::$ENDPOINT, 
					'/gatheringPool',
					$query);
	}
	
	/**
	 * ギャザリングプールを作成<br>
	 * <br>
	 * GS2-Realtime を利用するには、まずギャザリングプールを作成する必要があります。<br>
	 * ギャザリングプールには複数のギャザリングを紐付けることができます。<br>
	 * 
	 * @param array $request
	 * * name => マッチメイキング名
	 * * description => 説明文
	 * @return array
	 * * item
	 * 	* gatheringPoolId => ギャザリングプールID
	 * 	* ownerId => オーナーID
	 * 	* name => ギャザリングプール名
	 * 	* description => 説明文
	 * 	* createAt => 作成日時
	 */
	public function createGatheringPool($request) {
		if(is_null($request)) throw new NullPointerException();
		$body = [];
		if(array_key_exists('name', $request)) $body['name'] = $request['name'];
		if(array_key_exists('description', $request)) $body['description'] = $request['description'];
		$query = [];
		return $this->doPost(
					'Gs2Realtime', 
					'CreateGatheringPool', 
					Gs2RealtimeClient::$ENDPOINT, 
					'/gatheringPool',
					$body,
					$query);
	}

	/**
	 * ギャザリングプールを取得
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 * @return array
	 * * item
	 * 	* gatheringPoolId => ギャザリングプールID
	 * 	* ownerId => オーナーID
	 * 	* name => ギャザリングプール名
	 * 	* description => 説明文
	 * 	* createAt => 作成日時
	 */
	public function getGatheringPool($request) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		$query = [];
		return $this->doGet(
				'Gs2Realtime',
				'GetGatheringPool',
				Gs2RealtimeClient::$ENDPOINT,
				'/gatheringPool/'. $request['gatheringPoolName'],
				$query);
	}

	/**
	 * ギャザリングプールを更新
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 * * description => 説明文
	 * @return array
	 * * item
	 * 	* gatheringPoolId => ギャザリングプールID
	 * 	* ownerId => オーナーID
	 * 	* name => ギャザリングプール名
	 * 	* description => 説明文
	 * 	* createAt => 作成日時
	 */
	public function updateGatheringPool($request) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		$body = [];
		if(array_key_exists('description', $request)) $body['description'] = $request['description'];
		$query = [];
		return $this->doPut(
				'Gs2Realtime',
				'UpdateGatheringPool',
				Gs2RealtimeClient::$ENDPOINT,
				'/gatheringPool/'. $request['gatheringPoolName'],
				$body,
				$query);
	}
	
	/**
	 * ギャザリングプールを削除
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 */
	public function deleteGatheringPool($request) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		$query = [];
		return $this->doDelete(
					'Gs2Realtime', 
					'DeleteGatheringPool', 
					Gs2RealtimeClient::$ENDPOINT, 
					'/gatheringPool/'. $request['gatheringPoolName'],
					$query);
	}
	/**
	 * ギャザリングリストを取得
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 * @param string $pageToken ページトークン
	 * @param integer $limit 取得件数
	 * @return array
	 * * items
	 * 	* array
	 * 		* gatheringId => ギャザリングID
	 * 		* ownerId => オーナーID
	 * 		* name => ギャザリング名
	 * 		* hostId => ホストID
	 * 		* ipAddress => IPアドレス
	 * 		* port => 待ち受けポート
	 * 		* secret => 暗号鍵
	 * 		* userIds => 参加ユーザIDリスト
	 * 		* createAt => 作成日時
	 * * nextPageToken => 次ページトークン
	 */
	public function describeGathering($request, $pageToken = NULL, $limit = NULL) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		$query = [];
		if($pageToken) $query['pageToken'] = $pageToken;
		if($limit) $query['limit'] = $limit;
		return $this->doGet(
					'Gs2Realtime', 
					'DescribeGathering', 
					Gs2RealtimeClient::$ENDPOINT, 
					'/gatheringPool/'. $request['gatheringPoolName']. '/gathering',
					$query);
	}
	
	/**
	 * ギャザリングを作成<br>
	 * <br>
	 * ギャザリングを作成すると、ゲームサーバが起動します。<br>
	 * ゲームサーバはWebSocketで接続することができ、同じゲームサーバに接続しているユーザ間でメッセージをやり取りすることができます。<br>
	 * ゲームサーバとの通信プロトコルの説明については別途ドキュメントを確認してください。<br>
	 * <br>
	 * userIds にユーザIDを指定することで、ギャザリングに参加できるユーザのIDを制限することができます。<br>
	 * ギャザリング作成時に参加するユーザが確定している場合は指定してください。<br>
	 * 省略すると、暗号鍵を知っていれば誰でも参加することができます。<br>
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 * * name => ギャザリング名
	 * * userIds => 参加ユーザIDリスト
	 * @return array
	 * * item
	 * 	* gatheringId => ギャザリングID
	 * 	* ownerId => オーナーID
	 * 	* name => ギャザリング名
	 * 	* hostId => ホストID
	 * 	* ipAddress => IPアドレス
	 * 	* port => 待ち受けポート
	 * 	* secret => 暗号鍵
	 * 	* userIds => 参加ユーザIDリスト
	 * 	* createAt => 作成日時
	 */
	public function createGathering($request) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		$body = [];
		if(array_key_exists('name', $request)) $body['name'] = $request['name'];
		if(array_key_exists('userIds', $request)) {
			$body['userIds'] = $request['userIds'];
			if(is_array($body['userIds'])) $body['userIds'] = implode(',', $body['userIds']);
		}
		$query = [];
		return $this->doPost(
					'Gs2Realtime', 
					'CreateGathering', 
					Gs2RealtimeClient::$ENDPOINT, 
					'/gatheringPool/'. $request['gatheringPoolName']. '/gathering',
					$body,
					$query);
	}

	/**
	 * ギャザリングを取得
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 * * gatheringName => ギャザリング名
	 * @return array
	 * * item
	 * 	* gatheringId => ギャザリングID
	 * 	* ownerId => オーナーID
	 * 	* name => ギャザリング名
	 * 	* hostId => ホストID
	 * 	* ipAddress => IPアドレス
	 * 	* port => 待ち受けポート
	 * 	* secret => 暗号鍵
	 * 	* userIds => 参加ユーザIDリスト
	 * 	* createAt => 作成日時
	 */
	public function getGathering($request) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		if(!array_key_exists('gatheringName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringName'])) throw new NullPointerException();
		$query = [];
		return $this->doGet(
				'Gs2Realtime',
				'GetGathering',
				Gs2RealtimeClient::$ENDPOINT,
				'/gatheringPool/'. $request['gatheringPoolName']. '/gathering/'. $request['gatheringName'],
				$query);
	}
	
	/**
	 * ギャザリングを削除
	 * 
	 * @param array $request
	 * * gatheringPoolName => ギャザリングプール名
	 * * gatheringName => ギャザリング名
	 */
	public function deleteGathering($request) {
		if(is_null($request)) throw new NullPointerException();
		if(!array_key_exists('gatheringPoolName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringPoolName'])) throw new NullPointerException();
		if(!array_key_exists('gatheringName', $request)) throw new NullPointerException();
		if(is_null($request['gatheringName'])) throw new NullPointerException();
		$query = [];
		return $this->doDelete(
					'Gs2Realtime', 
					'DeleteGathering', 
					Gs2RealtimeClient::$ENDPOINT, 
					'/gatheringPool/'. $request['gatheringPoolName']. '/gathering/'. $request['gatheringName'],
					$query);
	}
}