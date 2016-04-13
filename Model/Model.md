# BackendAPI

BackendAPI is a RESTful API for the NJIT CS 490 project to interface with a database. It follows the CRUD standards for simplification. The API expects a POST request containing a JSON object to a single file named backend.php. The JSON file is decoded an command is executed. Once successful, a JSON object is returned containing a status code and conditionally data.

### Example

The URL to interface with the BackendAPI is [https://web.njit.edu/~jmd57/backend.php](https://web.njit.edu/~jmd57/backend.php)

One can use `curl` to interface with the API

```bash
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":1,"email":"jmd57@njit.edu","password":"randompassword","username":"jaspy123","firstname":"Jasper","lastname":"Davey","bio":"I like CS","events":["ACM","IEEE","NJIT Robotics Club","AlcHE"],"tags":{"#CS":2,"#ComputerScience":5,"#NJIT":7}}'`
echo "${result}"
```

In this example, we used `curl` to send a POST request to our `$url` with a JSON object containing a command. This command is what tells the API what you'd like to happen with the data you're supplying. In this specific example, we created a user with various attributes about the user we'd like to save. When we `echo "${result}"` we should see that we received a JSON object from the API that might look something like `{"status":200,"id":101}`. The `"status:200"` section of the JSON tells us that the operation successfully accomplished our goal. The `"id":101` section of our JSON is the unique ID associated with this new user.

### Commands

As said previously, each JSON must include a `"command:#"` to tell the API what operations you would like to perform.

#### + Create User

| Variable | Value | JSON | Description |
| -------- | -----:| ---- | ----------- |
| command  |   *1*   | "command":# | |
| firstname | *String* | "firstname":"String" | |
| lastname | *String* | "lastname":"String" | |
| username | *String* | "username":"String" | |
| email | *String* | "email":"String" | |
| password | *String* | "password":"String" | |
| bio | *String* | "bio":"String" | |
| events | *Array[ String ]* | "events":{"String","String"} | `id` of events user has attended / will attend |
| tags | *Array[ String:# ]* | "tags":{"#String":#, "#String:#"} | dictionary of tags of user interests with a nice value associated to measure user's level of interest |

*Status*

| Okay | Wrong password |
| :--: | :------------: |
| 200  | 404 |

#### + Authenticate User

| Variable | Value | JSON | Description |
| -------- | ----: | ---- | ----------- |
| command  |  *2*  | "command":2 | |
| email | *String* | "email":"String" | |
| password | *String* | "password":"String" | | |

*Status*

| Okay | User does not exist | Wrong password |
| :--: | :-----------------: | :------------: |
| 200 | 304 | 404 |

#### + Create Event

| Variable | Value | JSON | Description |
| -------- | ----: | ---- | ----------- |
| command | *3* | "command":3 |  |
| name | *String* | "name":"String" | |
| bio | *String* | "bio":"String" | |
| startDateTime | *String* | "startDateTime":"String" | format: `YYYY-MM-DD HH:MI:SS` |
| endDateTime | *String* | "endDateTime":"String" | format: `YYYY-MM-DD HH:MI:SS` |
| location | *String* | "location":"String" | |
| owner | *#* | "owner":# | `#` is the id of the owner of this event |

*Status*

| Okay | Wrong password |
| :--: | :------------: |
| 200  | 404 |
