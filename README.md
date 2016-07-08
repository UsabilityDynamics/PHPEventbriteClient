# PHPEventbriteClient
PHP Client for Eventbrite API v3

### Example

```php
$client = new EventbriteClient( ACCESS_TOKEN );
$attendees = $client->events()->id( 2659635063 )->attendees()->get();
```
