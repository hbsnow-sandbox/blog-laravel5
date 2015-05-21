<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;

class GoogleDrive
{
	protected $service;
	protected $file;

	/**
	 * コンストラクタ
	 *
	 * @param $file_id 読み込むファイルのID
	 */
	function __construct($file_id)
	{
		$service_account_name = '771469894700-jocje8h2hqjraebelnpafr2agvu1p29m@developer.gserviceaccount.com';
		$key_file_location = base_path() . '/resources/assets/Blog-c5b625870cd3.p12';

		$client = new \Google_Client();
		$this->service = new \Google_Service_Drive($client);

		if (Cache::has('service_token'))
		{
			$client->setAccessToken(Cache::get('service_token'));
		}

		$key = file_get_contents($key_file_location);
		$scopes = ['https://www.googleapis.com/auth/drive'];

		$auth = new \Google_Auth_AssertionCredentials($service_account_name, $scopes, $key);

		$client->setAssertionCredentials($auth);

		if ($client->getAuth()->isAccessTokenExpired())
		{
			$client->getAuth()->refreshTokenWithAssertion($auth);
		}

		Cache::forever('service_token', $client->getAccessToken());

		$this->file = $this->service->files->get($file_id);
	}

	/**
	 * ファイルのMarkdownを返す
	 *
	 * @return string
	 */
	public function getContent()
	{
		return file_get_contents($this->file->getWebContentLink());
	}

	/**
	 * ファイルの更新日を返す
	 *
	 * @param DateTime
	 *
	 * @return mix
	 */
	public function getModifiedDate($created)
	{
		$updated = new \DateTime($this->file->getModifiedDate());

		if ($updated < $created)
		{
			return null;
		}

		$interval = intval($created->diff($updated)->format('%d'));

		return $interval >= 1 ? $updated : null;
	}

	public function getDescription()
	{
		return $this->file->getDescription();
	}
}