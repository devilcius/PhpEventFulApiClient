[![CircleCI](https://circleci.com/gh/devilcius/PhpEventFulApiClient.svg?style=svg)](https://circleci.com/gh/devilcius/PhpEventFulApiClient)
Php EventFul Api Client
===============
A PHP client library for the [EventFul API](https://api.eventful.com/docs)

Installation
-----------
```bash
composer require devilcius/eventful-api
```

Quick Start
-----------

The main entry point of the library is the `EventFul\EventFulApiClient` class. Once you have
an EventFulApiClient instance, you can easily access all the API services and call their
methods. Any use of the Eventful API requires a valid, current application key. You can obtain one [here](https://api.eventful.com/keys)

Let's try to find an event using the `search` method of the `Event` service:

```php
<?php

// options:
$apiKey = 'secretAppKey'; // mandatory
$endPoint = 'http://api.evdb.com'; // optional
$timeout = 10; // optional
$userAgent = 'EventFul PHP Client'; // optional
$apiClient = new EventFulApiClient($apiKey, $endPoint, $timeout, $userAgent);

$service = $apiClient->getEventService();
$params['page_number'] = 1;
$params['page_size'] = 10;
$params['category'] = 'music';
$params['location'] = 'Madrid';
$result = $service->search($params);
foreach ($result->events->event as $event) {
    echo $event->title;
}

```

Tests
-----------
```bash
phpunit
```

Methods
-----------

| Service  | Method   | Description| Implemented   |
|---|---|---|:---:|
| **Event**  | new   |  Add a new event record. | :hourglass:    |
| **Event**  | get  | Get an event record.   | :hourglass:  |  
| **Event**  | modify  | Modify an event record.  | :hourglass: |
| **Event** | withdraw | Withdraw (delete, remove) an event.  | :hourglass: |
| **Event** | restore | Restore a withdrawn event.  | :hourglass: |
| **Event** | search | Search for events. | :heavy_check_mark: |
| **Event** | reindex | Update the search index for an event record. | :hourglass: |
| **Event** | ical | Get events in iCalendar format. | :hourglass: |
| **Event** | rss | Get events in RSS format. | :hourglass: |
| **Event** | tags/list | List all tags attached to an event. | :hourglass: |
| **Event** | going/list | List all users going to an event. | :hourglass: |
| **Event** | tags/new | Add tags to an event. | :hourglass: |
| **Event** | tags/remove | Remove tags from an event. | :hourglass: |
| **Event** | comments/new | Add a comment to an event. | :hourglass: |
| **Event** | comments/modify | Make changes to an event comment. | :hourglass: |
| **Event** | comments/delete | Remove a comment from an event. | :hourglass: |
| **Event** | links/new | Add a URL to an event. | :hourglass: |
| **Event** | links/delete | Remove a URL from an event. | :hourglass: |
| **Event** | images/add | Add an image to an event. | :hourglass: |
| **Event** | images/remove | Remove an image from an event. | :hourglass: |
| **Event** | performers/add | Add a performer to an event. | :hourglass: |
| **Event** | performers/remove | Remove a performer from an event. | :hourglass: |
| **Event** | properties/add | Add a property to an event. | :hourglass: |
| **Event** | properties/list | List properties for an event. | :hourglass: |
| **Event** | properties/remove | Remove a property from an event. | :hourglass: |
| **Event** | categories/add | Add a category to an event. | :hourglass: |
| **Event** | categories/remove | Remove a category from an event. |  :hourglass:|
| **Event** | dates/resolve | Resolve start and end dates from a date string. | :hourglass: |
| **Venue** | new | Add a new venue record. | :hourglass: |
| **Venue** | get | Get a venue record. | :hourglass: |
| **Venue** | modify | Make changes to a venue. | :hourglass: |
| **Venue** | withdraw | Withdraw (delete, remove) a venue. | :hourglass: |
| **Venue** | restore | Restore a withdrawn venue. | :hourglass: |
| **Venue** | search | Search for venues. | :hourglass: |
| **Venue** | tags/list | List all tags attached to an venue. | :hourglass: |
| **Venue** | tags/new | Add tags to an venue. | :hourglass: |
| **Venue** | tags/delete | Remove tags from an venue. | :hourglass: |
| **Venue** | ical | Get events at a venue in iCalendar format. | :hourglass: |
| **Venue** | rss | Get events at a venue in RSS format. | :hourglass: |
| **Venue** | comments/new | Add a comment to a venue. | :hourglass: |
| **Venue** | comments/modify | Make changes to a venue comment. | :hourglass: |
| **Venue** | comments/delete | Remove a comment from a venue. | :hourglass: |
| **Venue** | links/new | Add a URL to a venue. | :hourglass: |
| **Venue** | links/delete | Remove a URL from an event. | :hourglass: |
| **Venue** | properties/add | Add a property to an venue. | :hourglass: |
| **Venue** | properties/list | List properties for an venue. | :hourglass: |
| **Venue** | properties/remove | Remove a property from an venue. | :hourglass: |
| **Venue** | resolve | Resolve a venue from a location string. | :hourglass: |
| **User** | calendars/list | List a user's calendars. | :hourglass: |
| **User** | calendars/get | Get the settings for a user's calendar. | :hourglass: |
| **User** | get | Get a user record. | :hourglass: |
| **User** | search | Searches for users. | :heavy_check_mark: |
| **User** | groups/list | List the groups of which a user is a member. | :hourglass: |
| **User** | venue/list | List a user's recently added venues. | :hourglass: |
| **User** | locales/add | Add a locale to a user's saved locations. | :hourglass: |
| **User** | locales/list | List a user's saved locations. | :hourglass: |
| **User** | locales/delete | Delete a locale from a user's saved locations. | :hourglass: |
| **User** | going/add | Marks a user as "I'm going" to an event. | :hourglass: |
| **User** | going/remove | Removes a user from an event's "I'm going" list. | :hourglass: |
| **Image** | new | Add a new image. | :hourglass: |
| **Image** | delete | Delete an image. | :hourglass: |
| **Performer** | new | Add a new performer. | :hourglass: |
| **Performer** | get | Get the details for a performer. | :heavy_check_mark: |
| **Performer** | modify | Modify a performer. | :hourglass: |
| **Performer** | search | Search for performers. | :heavy_check_mark: |
| **Performer** | withdraw | Delete a performer. | :hourglass: |
| **Performer** | links/add | Add links to an performer. | :hourglass: |
| **Performer** | links/remove | Remove links from an performer. | :hourglass: |
| **Performer** | images/add | Add an image to a performer. | :hourglass: |
| **Performer** | images/remove | Remove an image from a performer. | :hourglass: |
| **Performer** | events/list | Get all events for a performer. | :hourglass: |
| **Performer** | xids/list | Get all performers based on external ids (facebook, etc). | :hourglass: |
| **Demand** | get | Get the details for a demand. | :hourglass: |
| **Demand** | search | Search for demands. | :hourglass: |
| **Category** | list | List the available categories. | :hourglass: |

