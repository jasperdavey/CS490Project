#variables

CAP = entity
' ' = variable to be used  

-USERID: 'user_id'
-PASSWORD: 'pass'
-EMAIL: 'email'

-ACCOUNT_TYPE: 'user_type'  => group || single_user
#if group
-GROUP_NAME: 'g_name'

#if single_user
-MAJOR: 'major'
-MINOR: 'minor'
-LEVEL: 'level'
-GRAD_MONTH_YR: 'grad_date'
-FIRSTNAME: 'f_name'
-LASTNAME: 'l_name'

#EVENTS object
-EVENT_NAME: 'event_title'
-EVENT_HOST: 'event_host'
-EVENT_LOCATION: 'event_location'
-EVENT TAGS: 'event_tags'
-EVENT DATE: 'event_date'
-EVENT TIME: 'event_time'
-EVENT RSVP: 'event_rsvp'
-EVENT PHONE NUMBER: 'event_phone'
-EVENT EMAIL:   'event_email'
-EVENT people who attended: 'event_attendees'

#EVENTS QUERY
-SEARCH_TAGS: 'tags'

-list of events user signed up for: 'user_attending_events'
-list of events user has gone to: 'user_past_events'
-list of events friends are attending: 'friends_going_to'

// Comments on events
- get comments for particular event - 'event_comments'
