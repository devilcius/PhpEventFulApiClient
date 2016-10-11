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
| **Event**  | get  | Get an event record.   | :heavy_check_mark:  |  
| **Event**  | modify  | Modify an event record.  | :hourglass: |
| **Event** | withdraw | Withdraw (delete, remove) an event.  | :hourglass: |
| **Event** | restore | Restore a withdrawn event.  | :hourglass: |
| **Event** | search | Search for events. | :heavy_check_mark: |
| **Event** | reindex | Update the search index for an event record. | :hourglass: |
| **Event** | tagsList | List all tags attached to an event. | :heavy_check_mark: |
| **Event** | goingList | List all users going to an event. | :heavy_check_mark: |
| **Event** | tagsNew | Add tags to an event. | :hourglass: |
| **Event** | tagsRemove | Remove tags from an event. | :hourglass: |
| **Event** | commentsNew | Add a comment to an event. | :hourglass: |
| **Event** | commentsModify | Make changes to an event comment. | :hourglass: |
| **Event** | commentsDelete | Remove a comment from an event. | :hourglass: |
| **Event** | linksNew | Add a URL to an event. | :hourglass: |
| **Event** | linksDelete | Remove a URL from an event. | :hourglass: |
| **Event** | imagesAdd | Add an image to an event. | :hourglass: |
| **Event** | imagesRemove | Remove an image from an event. | :hourglass: |
| **Event** | performersAdd | Add a performer to an event. | :hourglass: |
| **Event** | performersRemove | Remove a performer from an event. | :hourglass: |
| **Event** | propertiesAdd | Add a property to an event. | :hourglass: |
| **Event** | propertiesList | List properties for an event. | :heavy_check_mark: |
| **Event** | propertiesRemove | Remove a property from an event. | :hourglass: |
| **Event** | categoriesAdd | Add a category to an event. | :hourglass: |
| **Event** | categoriesRemove | Remove a category from an event. |  :hourglass:|
| **Event** | datesResolve | Resolve start and end dates from a date string. | :heavy_check_mark: |
| **Venue** | new | Add a new venue record. | :hourglass: |
| **Venue** | get | Get a venue record. | :heavy_check_mark: |
| **Venue** | modify | Make changes to a venue. | :hourglass: |
| **Venue** | withdraw | Withdraw (delete, remove) a venue. | :hourglass: |
| **Venue** | restore | Restore a withdrawn venue. | :hourglass: |
| **Venue** | search | Search for venues. | :heavy_check_mark: |
| **Venue** | tagsList | List all tags attached to an venue. | :heavy_check_mark: |
| **Venue** | tagsNew | Add tags to an venue. | :hourglass: |
| **Venue** | tagsDelete | Remove tags from an venue. | :hourglass: |
| **Venue** | commentsNew | Add a comment to a venue. | :hourglass: |
| **Venue** | commentsModify | Make changes to a venue comment. | :hourglass: |
| **Venue** | commentsDelete | Remove a comment from a venue. | :hourglass: |
| **Venue** | linksNew | Add a URL to a venue. | :hourglass: |
| **Venue** | linksDelete | Remove a URL from an event. | :hourglass: |
| **Venue** | propertiesAdd | Add a property to an venue. | :hourglass: |
| **Venue** | propertiesList | List properties for an venue. | :heavy_check_mark: |
| **Venue** | propertiesRemove | Remove a property from an venue. | :hourglass: |
| **Venue** | resolve | Resolve a venue from a location string. | :heavy_check_mark: |
| **User** | get | Get a user record. | :heavy_check_mark: |
| **User** | search | Searches for users. | :heavy_check_mark: |
| **User** | groupsList | List the groups of which a user is a member. | :heavy_check_mark: |
| **User** | venueList | List a user's recently added venues. | :hourglass: |
| **User** | localesAdd | Add a locale to a user's saved locations. | :hourglass: |
| **User** | localesList | List a user's saved locations. | :hourglass: |
| **User** | localesDelete | Delete a locale from a user's saved locations. | :hourglass: |
| **User** | goingAdd | Marks a user as "I'm going" to an event. | :hourglass: |
| **User** | goingRemove | Removes a user from an event's "I'm going" list. | :hourglass: |
| **Image** | new | Add a new image. | :hourglass: |
| **Image** | delete | Delete an image. | :hourglass: |
| **Performer** | new | Add a new performer. | :hourglass: |
| **Performer** | get | Get the details for a performer. | :heavy_check_mark: |
| **Performer** | modify | Modify a performer. | :hourglass: |
| **Performer** | search | Search for performers. | :heavy_check_mark: |
| **Performer** | withdraw | Delete a performer. | :hourglass: |
| **Performer** | linksAdd | Add links to an performer. | :hourglass: |
| **Performer** | linksRemove | Remove links from an performer. | :hourglass: |
| **Performer** | imagesAdd | Add an image to a performer. | :hourglass: |
| **Performer** | imagesRemove | Remove an image from a performer. | :hourglass: |
| **Performer** | eventsList | Get all events for a performer. | :heavy_check_mark: |
| **Performer** | xidsList | Get all performers based on external ids (facebook, etc). | :heavy_check_mark: |
| **Demand** | get | Get the details for a demand. | :heavy_check_mark: |
| **Demand** | search | Search for demands. | :heavy_check_mark: |
| **Category** | list | List the available categories. | :heavy_check_mark: |

