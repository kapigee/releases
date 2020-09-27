<?php
/**
 * SAML 2.0 remote IdP metadata for simpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://rnd.feide.no/content/idp-remote-metadata-reference
 *
 * Below is UCLA production server metadata
 */
$metadata['urn:mace:incommon:ucla.edu'] = array (
 'entityid' => 'urn:mace:incommon:ucla.edu',
 'description' =>
 array (
   'en' => 'University of California-Los Angeles',
 ),
 'OrganizationName' =>
 array (
   'en' => 'University of California-Los Angeles',
 ),
 'name' =>
 array (
   'en' => 'University of California-Los Angeles',
 ),
 'OrganizationDisplayName' =>
 array (
   'en' => 'University of California-Los Angeles',
 ),
 'url' =>
 array (
   'en' => 'http://www.ucla.edu/',
 ),
 'OrganizationURL' =>
 array (
   'en' => 'http://www.ucla.edu/',
 ),
 'contacts' =>
 array (
   0 =>
   array (
     'contactType' => 'support',
     'givenName' => 'UCLA API Support',
     'emailAddress' =>
     array (
       0 => 'api-support@it.ucla.edu',
     ),
   ),
   1 =>
   array (
     'contactType' => 'technical',
     'givenName' => 'Jeffrey Crawford',
     'emailAddress' =>
     array (
       0 => 'jcrawford@it.ucla.edu',
     ),
   ),
   2 =>
   array (
     'contactType' => 'other',
     'givenName' => 'UCLA IT Security',
     'emailAddress' =>
     array (
       0 => 'security@it.ucla.edu',
     ),
   ),
   3 =>
   array (
     'contactType' => 'administrative',
     'givenName' => 'Michael Van Norman',
     'emailAddress' =>
     array (
       0 => 'mvn@ucla.edu',
     ),
   ),
 ),
 'metadata-set' => 'shib13-idp-remote',
 'SingleSignOnService' =>
 array (
   0 =>
   array (
     'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
     'Location' => 'https://shb.ais.ucla.edu/shibboleth-idp/profile/SAML2/POST/SSO',
   ),
   1 =>
   array (
     'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
     'Location' => 'https://shb.ais.ucla.edu/shibboleth-idp/profile/SAML2/Redirect/SSO',
   ),
   2 =>
   array (
     'Binding' => 'urn:mace:shibboleth:1.0:profiles:AuthnRequest',
     'Location' => 'https://shb.ais.ucla.edu/shibboleth-idp/profile/Shibboleth/SSO',
   ),
 ),
 'ArtifactResolutionService' =>
 array (
   0 =>
   array (
     'Binding' => 'urn:oasis:names:tc:SAML:1.0:bindings:SOAP-binding',
     'Location' => 'https://shb.ais.ucla.edu:8443/shibboleth-idp/Artifact',
     'index' => 1,
   ),
 ),
 'keys' =>
 array (
   0 =>
   array (
     'encryption' => false,
     'signing' => true,
     'type' => 'X509Certificate',
     'X509Certificate' => '
MIIEUTCCAzmgAwIBAgIJAIJtSzeAEQM6MA0GCSqGSIb3DQEBBQUAMHgxCzAJBgNV
BAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlhMRQwEgYDVQQHEwtMb3MgQW5nZWxl
czENMAsGA1UEChMEVUNMQTEUMBIGA1UECxMLSVQgU2VydmljZXMxGTAXBgNVBAMT
EHNoYi5haXMudWNsYS5lZHUwHhcNMTUwMzE2MTYzMjIxWhcNMjUwMzEzMTYzMjIx
WjB4MQswCQYDVQQGEwJVUzETMBEGA1UECBMKQ2FsaWZvcm5pYTEUMBIGA1UEBxML
TG9zIEFuZ2VsZXMxDTALBgNVBAoTBFVDTEExFDASBgNVBAsTC0lUIFNlcnZpY2Vz
MRkwFwYDVQQDExBzaGIuYWlzLnVjbGEuZWR1MIIBIjANBgkqhkiG9w0BAQEFAAOC
AQ8AMIIBCgKCAQEAx4MeQrV/3QDtRRm09qcChOHKzD4RSnbrXnX0hI9WpZ5aBQa/
7y220/ZLa0y//rXsVovMW5/c2RcsOxbbrvzfB/8a2e4EkAY5nc97fgirCegH3znw
kLZrqBYx8XJhopd7K1zzpXHzEMVV3cpYlQvIsFsf6Kf3ZEcH30tkf+73C38En0uf
sP6QGkIj6q0FazJ9vLs/dcoyL03pXBH9pLf5F0rGceZu8KVBOTwNG03F3kPOW8t0
TaL7QRoMF42fqObVMcXagW9QtUExw05bNl97c4IpkT6/X6bOWOnUflcUJU1Epdp1
g3vbDZ1L9VxqGjbdHvP5EnfcakX1959jq9MiZwIDAQABo4HdMIHaMB0GA1UdDgQW
BBS8b/HXrXb/lOz+h7QMxxo/Zksp/TCBqgYDVR0jBIGiMIGfgBS8b/HXrXb/lOz+
h7QMxxo/Zksp/aF8pHoweDELMAkGA1UEBhMCVVMxEzARBgNVBAgTCkNhbGlmb3Ju
aWExFDASBgNVBAcTC0xvcyBBbmdlbGVzMQ0wCwYDVQQKEwRVQ0xBMRQwEgYDVQQL
EwtJVCBTZXJ2aWNlczEZMBcGA1UEAxMQc2hiLmFpcy51Y2xhLmVkdYIJAIJtSzeA
EQM6MAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADggEBAEw+u7bhNjgnU1zO
wEL/b8rZXlQf6+VdRxWYm6w0pFSOrcjjvspPM93453UoX8ILLe4dIi0teppahzNr
XhWPrWJ6SRxJaz/8QrAZhgWQDwcwfZSssdA79ltoDiZQ6Fce8Hz9G23BZ3LxbdaU
o1SyIYAshw5aijVaLg5wcZfwSnXxTByVhBa8m886tGrXrcsePeZv7/mrmfs+gJUS
2HyNjGtcyyVew+b6AjAPHjQTi45MAEdh/3n2cT/pBQq4pay+eZz8Lc42vx9kTCJt
dlAgNuktzNxcWzokLWe0ynwTAPsWPUaPvUjhanK418P+F5WzsgLpU8LTzWcr5ixK
E0JFJsE=
',
   ),
 ),
);
