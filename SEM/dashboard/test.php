<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/SAP/src/autoloader.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";
/*
  use GetOpt\GetOpt;
  use Google\Ads\GoogleAds\Examples\Utils\ArgumentNames;
  use Google\Ads\GoogleAds\Examples\Utils\ArgumentParser;
  use Google\Ads\GoogleAds\Lib\V1\GoogleAdsClient;
  use Google\Ads\GoogleAds\Lib\V1\GoogleAdsClientBuilder;
  use Google\Ads\GoogleAds\Lib\V1\GoogleAdsException;
  use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
  use Google\Ads\GoogleAds\V1\Errors\GoogleAdsError;
  use Google\Ads\GoogleAds\V1\Services\GoogleAdsRow;
  use Google\ApiCore\ApiException;
  //
  use Google\Ads\GoogleAds\V1\Services\MutateGoogleAdsRequest;
  use Google\Ads\GoogleAds\V1\Services\MutateGoogleAdsResponse;
  use Google\Ads\GoogleAds\V1\Services\MutateOperation;
  use Google\Ads\GoogleAds\V1\Services\SearchGoogleAdsRequest;
  use Google\Ads\GoogleAds\V1\Services\SearchGoogleAdsResponse;
  //use Google\ApiCore\ApiException;
  use Google\ApiCore\CredentialsWrapper;
  use Google\ApiCore\GapicClientTrait;
  use Google\ApiCore\RequestParamsHeaderDescriptor;
  use Google\ApiCore\RetrySettings;
  use Google\ApiCore\Transport\TransportInterface;
  use Google\ApiCore\ValidationException;
  use Google\Auth\FetchAuthTokenInterface;

  $customerId = "8223589907";
  $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();
  $googleAdsClient = (new GoogleAdsClientBuilder())
  ->fromFile()
  ->withOAuth2Credential($oAuth2Credential)
  ->build();
  $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();
  $query = 'SELECT campaign.id, campaign.name FROM campaign ORDER BY campaign.id';
  $response = $googleAdsServiceClient->search($customerId, $query, ['pageSize' => "100"]);

  foreach ($response->iterateAllElements() as $googleAdsRow) {

  printf(
  "<option value='%d'>%s</option>", $googleAdsRow->getCampaign()->getId()->getValue(), $googleAdsRow->getCampaign()->getName()->getValue(), PHP_EOL
  );
  }
 */

use Google_Client;

$client = new Google_Client(['client_id' => "388340202829-8so88lmjgqfsg7iceku47hs7tis1sp8k.apps.googleusercontent.com"]);
