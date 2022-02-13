### Direct usage

Per default `twill.schema` which extends default, you have ability to directly query Twill's default Models.

Models: `Feature`, `Block`, `File`, `Media`, `Setting`, `Tag`, `User`.

Below will be displayed possible queries usage for those models.

*   [Feature](#query-feature)
*   [Block](#query-block)
*   [File](#query-file)
*   [Media](#query-media)
*   [Setting](#query-setting)
*   [Tag](#query-tag)
*   [User](#query-user)

### Query Feature

All features

```graphql
{
    features {
        id
        feature_id
        feature_type
        bucket_key
        position
        starred
        created_at
        updated_at
    }
}
```

Specific feature

```graphql
{
    feature(id: 1) {
        id
        feature_id
        feature_type
        bucket_key
        position
        starred
        created_at
        updated_at
    }
}
```

### Query Block

All blocks

```graphql
{
    blocks {
        id
        blockable_id
        blockable_type
        position
        content
        type
        child_key
        parent_id
    }
}
```

Specific block

```graphql
{
    block(id: 1) {
        id
        blockable_id
        blockable_type
        position
        content
        type
        child_key
        parent_id
    }
}
```

### Query File

All files
```graphql
{
    files {
        id
        created_at
        updated_at
        filename
        uuid
        size
    }
}
```


Specific file by id
```graphql
{
    file(id: 2) {
        id
        created_at
        updated_at
        filename
        uuid
        size
    }
}
```

### Query Media

All medias

```graphql
{
    medias {
        id
        uuid
        alt_text
        width
        height
        caption
        filename
        created_at
        updated_at
    }
}
```

Specific media by id

```graphql
{
    media(id: 1) {
        id
        uuid
        alt_text
        width
        height
        caption
        filename
        created_at
        updated_at
    }
}
```

### Query Setting

All settings

```graphql
{
    settings {
        id
        key
        section
        created_at
        updated_at
    }
}
```

Specific setting by id

```graphql
{
    setting(id: 1) {
        id
        key
        section
        created_at
        updated_at
    }
}
```

### Query Tag

All tags

```graphql
{
    tags {
        id
        namespace
        slug
        name
        count
    }
}
```

Specific tag

```graphql
{
    tag(id: 1) {
        id
        namespace
        slug
        name
        count
    }
}
```

### Query User

All users

```graphql
{
    users {
        id
        published
        name
        email
        role
        title
        description
        language
        created_at
        updated_at
    }
}
```

Specific user by id

```graphql
{
    user(id: 1) {
        id
        published
        name
        email
        role
        title
        description
        language
        created_at
        updated_at
    }
}
```