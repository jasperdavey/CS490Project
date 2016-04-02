# CS490Project
Repository for the CS 490 project

URL for backend requests: https://web.njit.edu/~jmd57/model.php

### Understanding JSON status codes:

404 - User not found

304 - Wrong password provided

200 - User and password both valid

### Unit tests for CS490Project

Please use this directory to store unit tests that use all 3 abstrations of the MVC model. This will include system wide tests. Individual specialized tests that focus on your own abstraction should reside and be maintained inside each abstraction directory.

## Beta Milestone
1. User can create events
2. Users can sign up for events
3. Users are recommended events
4. Users can link events to personal calendar

###Front
####Need these
-a list of all tags in the database; 
-when returning events: I need all information about the event. 
-must be able to modify events 
-need to be able to friend another user (add to friends list)
-must be able to request a list of all user in the database : (this can just return the username and id);
- landing page
- login page
- signup page
- dashboard
- - - Upcoming events
- - - recommendations
- - - events friends going to
- - - search bar
- - - user's name
- - - user's profile pic
- user profile
- - - user's name
- - - user's pic
- - - user's friends
- - - user's past and upcoming events
- - - link to user's social media
- events page
- creating events page

###Mid
Handle queries
- events by tags
- events by name
- user events (past or future)
Dashboard
- Recommendations
- events friends going to

###Back
User
- name
- NJIT email
- bio
- pic
- password
- list of events
- dictionary of tags : nice_value
- friends list

Event
- Name
- pics
- list of tags
- bio
- date & time & location of event
- comments ( user )
