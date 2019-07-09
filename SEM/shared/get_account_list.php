<?php

/**
 * Copyright 2019 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Ads\GoogleAds\Examples\AccountManagement;

use Google\Ads\GoogleAds\Lib\V1\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V1\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V1\GoogleAdsException;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Util\V1\ResourceNames;
use Google\Ads\GoogleAds\V1\Errors\GoogleAdsError;
use Google\ApiCore\ApiException;

/**
 * This example lists the resource names for the customers that the authenticating user has access
 * to.
 *
 * The customer IDs retrieved from the resource names can be used to set
 * the login-customer-id configuration. For more information see this
 * documentation:
 * https://developers.google.com/google-ads/api/docs/concepts/call-structure#login-customer-id
 */
class ListAccessibleCustomers {

    const PAGE_SIZE = 1000;

    public static function main() {

        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();
        $googleAdsClient = (new GoogleAdsClientBuilder())->fromFile()
                ->withOAuth2Credential($oAuth2Credential)
                ->build();

        try {
            $results = self::runExample($googleAdsClient);
        } catch (GoogleAdsException $googleAdsException) {
            $results["status"] = "error";
            $message = $googleAdsException->getRequestId();
            $results["results"] = "Request with ID '$message' has failed.";
            $results["errors"] = array();
            foreach ($googleAdsException->getGoogleAdsFailure()->getErrors() as $error) {
                /** @var GoogleAdsError $error */
                $error_code = $error->getErrorCode()->getErrorCode();
                $error_message = $error->getMessage();
                $temp = array(
                    "code" => $error_code,
                    "message" => $error_message
                );
                array_push($results["errors"], $temp);
            }
        } catch (ApiException $apiException) {
            $results["status"] = "error";
            $message = $apiException->getMessage();
            $results["results"] = "ApiException was thrown with message '$message'.";
            $results["errors"] = array();
        }

        return $results;
    }

    /**
     * Runs the example.
     *
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     */
    public static function runExample(GoogleAdsClient $googleAdsClient) {
        $results = array();
        $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
        $accessibleCustomers = $customerServiceClient->listAccessibleCustomers();
        $results["status"] = "success";
        $results["results"] = array();
        foreach ($accessibleCustomers->getResourceNames() as $resourceName) {
            $pos = strpos($resourceName, "/") + 1;
            $id = substr($resourceName, $pos, strlen($resourceName));
            try {
                $_customer = self::getCustomerDetails($googleAdsClient, $id);
                if ($_customer) {
                    array_push($results["results"], $_customer);
                }
            } catch (GoogleAdsException $googleAdsException) {
                //printf(
                //        "Request with ID '%s' has failed.%sGoogle Ads failure details:%s", $googleAdsException->getRequestId(), PHP_EOL, PHP_EOL
                //);
                foreach ($googleAdsException->getGoogleAdsFailure()->getErrors() as $error) {
                    /** @var GoogleAdsError $error */
                    //    printf(
                    //            "\t%s: %s%s", $error->getErrorCode()->getErrorCode(), $error->getMessage(), PHP_EOL
                    //    );
                }
            } catch (ApiException $apiException) {
                //printf(
                //        "ApiException was thrown with message '%s'.%s", $apiException->getMessage(), PHP_EOL
                //);
            }
        }

        return $results;
    }

    public static function getCustomerDetails(GoogleAdsClient $googleAdsClient, $customerId) {
        $customerServiceClient = $googleAdsClient->getCustomerServiceClient();
        $customer = $customerServiceClient->getCustomer(ResourceNames::forCustomer($customerId));
        if ($customer) {
            $temp = array(
                "id" => $customer->getId()->getValue(),
                "name" => $customer->getDescriptiveName()->getValue()
            );
            return $temp;
        } else {
            
        }
        //$customer->getId()->getValue(), 
        //$customer->getDescriptiveName()->getValue(), 
        //$customer->getCurrencyCode()->getValue(), 
        //$customer->getTimeZone()->getValue(), 
        //$customer->getTrackingUrlTemplate()->getValue(), 
        //$customer->getAutoTaggingEnabled()->getValue() ? 'true' : 'false', PHP_EOL
    }

}

$accounts = ListAccessibleCustomers::main();
return $accounts;

