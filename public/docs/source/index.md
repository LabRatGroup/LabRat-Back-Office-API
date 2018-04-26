---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](https://www.labrat.dev/docs/collection.json)
<!-- END_INFO -->

#Project
          Allows the management or machine learning modeling and prediction of general projects.
<!-- START_da399b969b44573892ec90a67150594c -->
## Project list
Retrieves the list of all available project for which the current user has access to.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/project" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/project`

`HEAD api/project`


<!-- END_da399b969b44573892ec90a67150594c -->

<!-- START_3f614cd13387dfbb921d91a6a9623fb6 -->
## Shows single project item.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/project/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/project/show/{id}`

`HEAD api/project/show/{id}`


<!-- END_3f614cd13387dfbb921d91a6a9623fb6 -->

<!-- START_47979fd258c4ec23ffc1d7cf833549e9 -->
## Creates a new project.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/create" \
-H "Accept: application/json" \
    -d "title"="sapiente" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/create",
    "method": "POST",
    "data": {
        "title": "sapiente"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/create`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Minimum: `5` Maximum: `255`

<!-- END_47979fd258c4ec23ffc1d7cf833549e9 -->

<!-- START_cd70468011e4f048588577969112c0b9 -->
## Updates project data.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/{id}/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/{id}/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/{id}/update`


<!-- END_cd70468011e4f048588577969112c0b9 -->

<!-- START_add9c644cb7fae228e5bd6fbc73c165f -->
## Soft-deletes project and dependencies.

> Example request:

```bash
curl -X DELETE "https://www.labrat.dev/api/project/{id}/delete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/{id}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/project/{id}/delete`


<!-- END_add9c644cb7fae228e5bd6fbc73c165f -->

#general
<!-- START_bfa63def5b4311761b96064a23191cdb -->
## Password recovery action.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/recover" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/recover",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/recover`


<!-- END_bfa63def5b4311761b96064a23191cdb -->

<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Registers new user and send auth token.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/register" \
-H "Accept: application/json" \
    -d "email"="milo77@example.org" \
    -d "name"="et" \
    -d "password"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/register",
    "method": "POST",
    "data": {
        "email": "milo77@example.org",
        "name": "et",
        "password": "et"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Maximum: `255`
    name | string |  required  | 
    password | string |  required  | 

<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Checks user identity based upon email and password and returns an auth token back to the user.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## Logs out authenticated user.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/logout",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_ced989bd755ac83a61eba55946056b1d -->
## Removes a user from the system.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/un-register" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/un-register",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/un-register`


<!-- END_ced989bd755ac83a61eba55946056b1d -->

<!-- START_9fc40cf09590bcc2e297184c25ce4de2 -->
## List all available teams associated to a user.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/team" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/team`

`HEAD api/team`


<!-- END_9fc40cf09590bcc2e297184c25ce4de2 -->

<!-- START_3303312c8de27a3b009872d093612314 -->
## Shows single team item.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/team/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/team/show/{id}`

`HEAD api/team/show/{id}`


<!-- END_3303312c8de27a3b009872d093612314 -->

<!-- START_6915e2b96c938e704e369c05de12d269 -->
## Creates a new team.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/team/create" \
-H "Accept: application/json" \
    -d "name"="neque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/create",
    "method": "POST",
    "data": {
        "name": "neque"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/team/create`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Minimum: `5` Maximum: `255`

<!-- END_6915e2b96c938e704e369c05de12d269 -->

<!-- START_29ad159076fcce599fe6c2f735995038 -->
## Updates team info.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/team/{id}/update" \
-H "Accept: application/json" \
    -d "name"="nostrum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/{id}/update",
    "method": "POST",
    "data": {
        "name": "nostrum"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/team/{id}/update`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Minimum: `5` Maximum: `255`

<!-- END_29ad159076fcce599fe6c2f735995038 -->

<!-- START_f746074b74cf51b280d26ef54930c8fa -->
## Removes team and relations.

> Example request:

```bash
curl -X DELETE "https://www.labrat.dev/api/team/{id}/delete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/{id}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/team/{id}/delete`


<!-- END_f746074b74cf51b280d26ef54930c8fa -->

<!-- START_74ead76fbadb3206188a72fcbf43e38b -->
## Adds a user as a team member.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/team/addMember" \
-H "Accept: application/json" \
    -d "user_id"="sunt" \
    -d "team_id"="sunt" \
    -d "is_owner"="sunt" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/addMember",
    "method": "POST",
    "data": {
        "user_id": "sunt",
        "team_id": "sunt",
        "is_owner": "sunt"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/team/addMember`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | 
    team_id | string |  required  | 
    is_owner | string |  required  | 

<!-- END_74ead76fbadb3206188a72fcbf43e38b -->

<!-- START_c1a6514affb3336d67e72567a8eb88d0 -->
## Updates a member-team relation.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/team/updateMember" \
-H "Accept: application/json" \
    -d "user_id"="enim" \
    -d "team_id"="enim" \
    -d "is_owner"="enim" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/updateMember",
    "method": "POST",
    "data": {
        "user_id": "enim",
        "team_id": "enim",
        "is_owner": "enim"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/team/updateMember`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | 
    team_id | string |  required  | 
    is_owner | string |  required  | 

<!-- END_c1a6514affb3336d67e72567a8eb88d0 -->

<!-- START_22203b29f9976165ebface610b977cae -->
## Removes member from team.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/team/deleteMember" \
-H "Accept: application/json" \
    -d "user_id"="sit" \
    -d "team_id"="sit" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/team/deleteMember",
    "method": "POST",
    "data": {
        "user_id": "sit",
        "team_id": "sit"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/team/deleteMember`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | 
    team_id | string |  required  | 

<!-- END_22203b29f9976165ebface610b977cae -->

<!-- START_ff3deccba9095c32a6f07c8d9d55322f -->
## Adds a new member to project.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/addMember" \
-H "Accept: application/json" \
    -d "user_id"="nemo" \
    -d "project_id"="nemo" \
    -d "is_owner"="nemo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/addMember",
    "method": "POST",
    "data": {
        "user_id": "nemo",
        "project_id": "nemo",
        "is_owner": "nemo"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/addMember`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | 
    project_id | string |  required  | 
    is_owner | string |  required  | 

<!-- END_ff3deccba9095c32a6f07c8d9d55322f -->

<!-- START_90550e7b0010f7534e36165a1749218e -->
## Updates member properties from project.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/updateMember" \
-H "Accept: application/json" \
    -d "user_id"="voluptates" \
    -d "project_id"="voluptates" \
    -d "is_owner"="voluptates" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/updateMember",
    "method": "POST",
    "data": {
        "user_id": "voluptates",
        "project_id": "voluptates",
        "is_owner": "voluptates"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/updateMember`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | 
    project_id | string |  required  | 
    is_owner | string |  required  | 

<!-- END_90550e7b0010f7534e36165a1749218e -->

<!-- START_7088379251cbb2a03255a5b3b13d8b00 -->
## Removes member from project.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/deleteMember" \
-H "Accept: application/json" \
    -d "user_id"="perferendis" \
    -d "project_id"="perferendis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/deleteMember",
    "method": "POST",
    "data": {
        "user_id": "perferendis",
        "project_id": "perferendis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/deleteMember`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | 
    project_id | string |  required  | 

<!-- END_7088379251cbb2a03255a5b3b13d8b00 -->

<!-- START_ce7f6bfd815c91c991e07386474ed19b -->
## Associates a team to a project.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/addTeam" \
-H "Accept: application/json" \
    -d "team_id"="ducimus" \
    -d "project_id"="ducimus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/addTeam",
    "method": "POST",
    "data": {
        "team_id": "ducimus",
        "project_id": "ducimus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/addTeam`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    team_id | string |  required  | 
    project_id | string |  required  | 

<!-- END_ce7f6bfd815c91c991e07386474ed19b -->

<!-- START_24e199c818c90feb4fa62a2ab6e1e142 -->
## Removes team from project.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/project/deleteTeam" \
-H "Accept: application/json" \
    -d "team_id"="autem" \
    -d "project_id"="autem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/project/deleteTeam",
    "method": "POST",
    "data": {
        "team_id": "autem",
        "project_id": "autem"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/project/deleteTeam`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    team_id | string |  required  | 
    project_id | string |  required  | 

<!-- END_24e199c818c90feb4fa62a2ab6e1e142 -->

<!-- START_0c81e6cee7604c608a73ebff588ce83b -->
## Display al models.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/models/project/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/models/project/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/models/project/{id}`

`HEAD api/models/project/{id}`


<!-- END_0c81e6cee7604c608a73ebff588ce83b -->

<!-- START_bce1b8e72021fd4200910c309567d9bb -->
## Display model details.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/model/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/model/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/model/show/{id}`

`HEAD api/model/show/{id}`


<!-- END_bce1b8e72021fd4200910c309567d9bb -->

<!-- START_1855c4ce74f4f04ed96fc9b7f09010ac -->
## Creates a new ml model.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/model/create" \
-H "Accept: application/json" \
    -d "title"="adipisci" \
    -d "project_id"="adipisci" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/model/create",
    "method": "POST",
    "data": {
        "title": "adipisci",
        "project_id": "adipisci"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/model/create`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Minimum: `5` Maximum: `255`
    project_id | string |  required  | 

<!-- END_1855c4ce74f4f04ed96fc9b7f09010ac -->

<!-- START_3fc5227052f7f3730041964da3176bcb -->
## Updates current model.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/model/{id}/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/model/{id}/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/model/{id}/update`


<!-- END_3fc5227052f7f3730041964da3176bcb -->

<!-- START_eb599116483fee2a2ad60d5c3b18b2b3 -->
## Deletes model.

> Example request:

```bash
curl -X DELETE "https://www.labrat.dev/api/model/{id}/delete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/model/{id}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/model/{id}/delete`


<!-- END_eb599116483fee2a2ad60d5c3b18b2b3 -->

<!-- START_24046b3387400950d476a92727dc69fc -->
## Retrieves all available algorithms.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/algorithm" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/algorithm",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/algorithm`

`HEAD api/algorithm`


<!-- END_24046b3387400950d476a92727dc69fc -->

<!-- START_3e4e4512a3fdd7699f46468cf66c9ec1 -->
## Get algorithm by ID with available params.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/algorithm/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/algorithm/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/algorithm/show/{id}`

`HEAD api/algorithm/show/{id}`


<!-- END_3e4e4512a3fdd7699f46468cf66c9ec1 -->

<!-- START_2a9843a4f16496f919e9ce2b1248cc7c -->
## Retrieves all model states by model id.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/state/model/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/state/model/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/state/model/{id}`

`HEAD api/state/model/{id}`


<!-- END_2a9843a4f16496f919e9ce2b1248cc7c -->

<!-- START_fc0941a18ce4a9f3cf923119f4025b48 -->
## Displays model state by id.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/state/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/state/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/state/show/{id}`

`HEAD api/state/show/{id}`


<!-- END_fc0941a18ce4a9f3cf923119f4025b48 -->

<!-- START_592e887475ea7dad16a6ffea16d3d35f -->
## Creates a new model state.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/state/create" \
-H "Accept: application/json" \
    -d "params"="ratione" \
    -d "ml_model_id"="ratione" \
    -d "ml_algorithm_id"="ratione" \
    -d "file"="ratione" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/state/create",
    "method": "POST",
    "data": {
        "params": "ratione",
        "ml_model_id": "ratione",
        "ml_algorithm_id": "ratione",
        "file": "ratione"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/state/create`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    params | string |  required  | 
    ml_model_id | string |  required  | 
    ml_algorithm_id | string |  required  | 
    file | string |  required  | 

<!-- END_592e887475ea7dad16a6ffea16d3d35f -->

<!-- START_60a4cefd9f45bfa95b0b877b2de8c9f6 -->
## Updates a model state and generates a new one.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/state/{id}/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/state/{id}/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/state/{id}/update`


<!-- END_60a4cefd9f45bfa95b0b877b2de8c9f6 -->

<!-- START_d43e7fd419861b252a93bf0ad765e016 -->
## Deletes model state.

> Example request:

```bash
curl -X DELETE "https://www.labrat.dev/api/state/{id}/delete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/state/{id}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/state/{id}/delete`


<!-- END_d43e7fd419861b252a93bf0ad765e016 -->

<!-- START_38e7dc3088adb3c0d597d3cdfaa5defd -->
## Set model state to current default for further predictions.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/state/{id}/current" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/state/{id}/current",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/state/{id}/current`


<!-- END_38e7dc3088adb3c0d597d3cdfaa5defd -->

<!-- START_62a2ec908dd365cf0893421f7e2435ad -->
## Sisplays state score.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/score/state/{id}/show" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/score/state/{id}/show",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/score/state/{id}/show`

`HEAD api/score/state/{id}/show`


<!-- END_62a2ec908dd365cf0893421f7e2435ad -->

<!-- START_f6cf1ce96af1dd1ef5624b78d06391ea -->
## Retrieves all model predictions.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/prediction/model/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/prediction/model/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/prediction/model/{id}`

`HEAD api/prediction/model/{id}`


<!-- END_f6cf1ce96af1dd1ef5624b78d06391ea -->

<!-- START_08ace2e1846112119d84374572e2c834 -->
## Displays model prediction by id.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/prediction/show/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/prediction/show/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/prediction/show/{id}`

`HEAD api/prediction/show/{id}`


<!-- END_08ace2e1846112119d84374572e2c834 -->

<!-- START_c0781b051ec5e576fc04957dfeee8918 -->
## api/prediction/create

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/prediction/create" \
-H "Accept: application/json" \
    -d "ml_model_id"="dolore" \
    -d "file"="dolore" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/prediction/create",
    "method": "POST",
    "data": {
        "ml_model_id": "dolore",
        "file": "dolore"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/prediction/create`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    ml_model_id | string |  required  | 
    file | string |  required  | 

<!-- END_c0781b051ec5e576fc04957dfeee8918 -->

<!-- START_21ebfb4bdd22640911d455e87bc5a2c0 -->
## Updated current prediction.

> Example request:

```bash
curl -X POST "https://www.labrat.dev/api/prediction/{id}/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/prediction/{id}/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/prediction/{id}/update`


<!-- END_21ebfb4bdd22640911d455e87bc5a2c0 -->

<!-- START_9bfba7a884bdf28b24c2aaa4b37bc857 -->
## Removes prediction.

> Example request:

```bash
curl -X DELETE "https://www.labrat.dev/api/prediction/{id}/delete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/prediction/{id}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/prediction/{id}/delete`


<!-- END_9bfba7a884bdf28b24c2aaa4b37bc857 -->

<!-- START_f9d311d9b23d1b61832f415e31409866 -->
## Manually re-runs an existing prediction.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/prediction/{id}/run" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/prediction/{id}/run",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/prediction/{id}/run`

`HEAD api/prediction/{id}/run`


<!-- END_f9d311d9b23d1b61832f415e31409866 -->

<!-- START_ef2bb990ee2b0640dd204b1f7297c647 -->
## Displays prediction score data.

> Example request:

```bash
curl -X GET "https://www.labrat.dev/api/score/prediction/{id}/show" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/score/prediction/{id}/show",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Token not provided",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\UnauthorizedHttpException",
    "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
    "line": 52,
    "trace": [
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/BaseMiddleware.php",
            "line": 67,
            "function": "checkForToken",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/tymon\/jwt-auth\/src\/Http\/Middleware\/Authenticate.php",
            "line": 30,
            "function": "authenticate",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\BaseMiddleware",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Tymon\\JWTAuth\\Http\\Middleware\\Authenticate",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 661,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 602,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 591,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Generators\/LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Mpociot\/ApiDoc\/Commands\/GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 564,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 865,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 241,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/symfony\/console\/Application.php",
            "line": 143,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 122,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/jfernandez\/Git\/LabRat\/LabRat-Back-Office-API\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/score/prediction/{id}/show`

`HEAD api/score/prediction/{id}/show`


<!-- END_ef2bb990ee2b0640dd204b1f7297c647 -->

<!-- START_8a9d63920cb8e5b67e7a14719e245d1a -->
## Deletes prediction score data.

> Example request:

```bash
curl -X DELETE "https://www.labrat.dev/api/score/prediction/{id}/delete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://www.labrat.dev/api/score/prediction/{id}/delete",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/score/prediction/{id}/delete`


<!-- END_8a9d63920cb8e5b67e7a14719e245d1a -->

