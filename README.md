[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Discord](https://img.shields.io/discord/340197684688453632.svg?label=&logo=discord&logoColor=ffffff&color=7389D8&labelColor=6A7EC2)](https://discord.gg/CYHuDpx)
<br>

<img src="https://cdn.the-systems.eu/icon-transparent-banner.png" width="300px" />

# <b>TheSystems OAuth2 Example</b>
(Language: PHP)

#### You can create an APP at https://www.the-systems.eu/dashboard/settings/clients

<br>
TokenURL: https://oauth2.the-systems.eu/oauth/token <br>

> Post Request<br>
> "grant_type" => "authorization_code", <br>
> "client_id" => CLIENT_ID, <br>
> "client_secret" => CLIENT_SECRET, <br>
> "redirect_uri" => REDIRECT_URI, <br>
> "code" => CODE

<br>

ResourceURL: https://oauth2.the-systems.eu/oauth/resource/user + https://oauth2.the-systems.eu/oauth/resource/user/address <br>
> Header for Request: <br>
> Authorization: Bearer ACCESSTOKEN

<br>

AuthorizeURL: https://oauth2.the-systems.eu/oauth/authorize <br>
> Example: https://oauth2.the-systems.eu/oauth/authorize?response_type=code&client_id=CLIENTID&state=xyz&redirect_uri=domain.de


## Support

- via Discord: https://discord.gg/CYHuDpx
- via Github-Issue: https://github.com/The-Systems/oauth/issues
- via E-Mail to moritz.walter@the-systems.eu

## License

    Copyright 2021 TheSystems
    
    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at
    
        http://www.apache.org/licenses/LICENSE-2.0
    
    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.

## Contributors

<a href="https://github.com/The-Systems/oauth/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=The-Systems/oauth" alt="Contributors"/>
</a>

<br>

### thank you, for using our software.



