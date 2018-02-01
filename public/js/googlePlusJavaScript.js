/**
 * Created by Fathy.Tarek on 2/1/2018.
 */

function getAccessToken(googleObject){
    return googleObject.getAuthResponse('access_token').access_token;
}

function getAccessTokenExpiresIn(googleObject){
    return googleObject.getAuthResponse('access_token').expires_in;
}