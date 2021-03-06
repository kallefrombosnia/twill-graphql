### Authentication & security :lock:

To create auth based queries and mutations you should follow the Lighthouse concept.

Lighthouse directives:
*   [@auth](https://lighthouse-php.com/master/api-reference/directives.html#auth)
*   [@can](https://lighthouse-php.com/master/api-reference/directives.html#can)
*   [@guard](https://lighthouse-php.com/master/api-reference/directives.html#guard)

Those directives provides us very easy way to protect our routes trough standard Laravel authentication method.


Best way to get the idea of implementation is to check their section for [Security](https://lighthouse-php.com/master/security/authentication.html).

Twill Gate list:
*   `list`
*   `edit`
*   `reorder`
*   `publish`
*   `feature`
*   `delete`
*   `duplicate`
*   `upload`
*   `manager-users`
*   `edit-user`
*   `publish-user`
*   `impersonate`

### GraphQL Authentication and Authorization (non Twill)

You can check this awesome tutorial by Toptal developer Christopher Moore.
[Tutorial](https://www.toptal.com/graphql/laravel-graphql-server-tutorial)