# UserApi

All URIs are relative to *http://example.com/api/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getUserByName**](UserApi.md#getUserByName) | **GET** /users/{username} | Get user by user name
[**updateUser**](UserApi.md#updateUser) | **PUT** /users/{username} | Updated user


<a name="getUserByName"></a>
# **getUserByName**
> Usersusername getUserByName(username, withEmail, prettyPrint)

Get user by user name

Some description of the operation.  You can use &#x60;markdown&#x60; here. 

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UserApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://example.com/api/v1");
    
    // Configure API key authorization: api_key
    ApiKeyAuth api_key = (ApiKeyAuth) defaultClient.getAuthentication("api_key");
    api_key.setApiKey("YOUR API KEY");
    // Uncomment the following line to set a prefix for the API key, e.g. "Token" (defaults to null)
    //api_key.setApiKeyPrefix("Token");

    // Configure OAuth2 access token for authorization: main_auth
    OAuth main_auth = (OAuth) defaultClient.getAuthentication("main_auth");
    main_auth.setAccessToken("YOUR ACCESS TOKEN");

    UserApi apiInstance = new UserApi(defaultClient);
    String username = "username_example"; // String | The name that needs to be fetched
    Boolean withEmail = true; // Boolean | Filter users without email
    Boolean prettyPrint = true; // Boolean | Pretty print response
    try {
      Usersusername result = apiInstance.getUserByName(username, withEmail, prettyPrint);
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling UserApi#getUserByName");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **String**| The name that needs to be fetched |
 **withEmail** | **Boolean**| Filter users without email | [optional]
 **prettyPrint** | **Boolean**| Pretty print response | [optional]

### Return type

[**Usersusername**](Usersusername.md)

### Authorization

[api_key](../README.md#api_key), [main_auth](../README.md#main_auth)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Success |  -  |
**403** | Forbidden |  -  |
**404** | User not found |  -  |

<a name="updateUser"></a>
# **updateUser**
> updateUser(username, body, prettyPrint)

Updated user

This can only be done by the logged in user.

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UserApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://example.com/api/v1");
    
    // Configure OAuth2 access token for authorization: main_auth
    OAuth main_auth = (OAuth) defaultClient.getAuthentication("main_auth");
    main_auth.setAccessToken("YOUR ACCESS TOKEN");

    UserApi apiInstance = new UserApi(defaultClient);
    String username = "username_example"; // String | The name that needs to be updated
    Usersusername body = new Usersusername(); // Usersusername | Updated user object
    Boolean prettyPrint = true; // Boolean | Pretty print response
    try {
      apiInstance.updateUser(username, body, prettyPrint);
    } catch (ApiException e) {
      System.err.println("Exception when calling UserApi#updateUser");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **username** | **String**| The name that needs to be updated |
 **body** | **Usersusername**| Updated user object |
 **prettyPrint** | **Boolean**| Pretty print response | [optional]

### Return type

null (empty response body)

### Authorization

[main_auth](../README.md#main_auth)

### HTTP request headers

 - **Content-Type**: application/json, application/xml
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | OK |  -  |
**400** | Invalid user supplied |  -  |
**404** | User not found |  -  |

