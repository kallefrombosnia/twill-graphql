# twill-graphql documentation :book:

This is a temporary documentation and it will be rewritten in Docusaurus 2.


Documentation
-----
- [Package documentation][1]
- [Eloquent usage][2]
- [Mutations][5]
- [Direct usage][3]
- [Authentication][4]
- [Notes](#notes)

### Notes

*   If you have clients which are not residing on the same domain you should enable CORS in `./config/cors.php`

```php
return [
-   'paths' => ['api/*', 'sanctum/csrf-cookie'],
+   'paths' => ['api/*', 'graphql', 'sanctum/csrf-cookie'],
    ...
];
```

*   If you do not want to enable the GraphQL playground in production, you can disable it in the config file. The easiest way is to set the environment variable `GRAPHQL_PLAYGROUND_ENABLED=false`.

[1]: https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/package
[2]: https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/eloquent
[3]: https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/direct
[4]: https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/AUTHENTICATION.md
[5]: https://github.com/kallefrombosnia/twill-graphql/tree/master/docs/mutations
