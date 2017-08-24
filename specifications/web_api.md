# Web API

A simple barebones API for querying a player profile, banning, unbanning, and storing arbitrary data.

Implementations in the `web` folder must only expose the API ; implementation of database connectivity and manipulation should be done within their `regisrtylib` directories, and the APIs talk to the library, without querying the database themselves.

## Format

The result data should be returned as Lua serialized data -- Minetest implements a safe deserialization function so *should* be impervious to injection...

	return {
		result = {                   -- Required
			"message" = message, -- Optional
			"code" : result_code -- 0 for success
		},

		player = {                   -- for status for example
			banned = <boolean>,
			token = tokendata
		},
	}

## Calls

We can call a registry with the following commands and data; errors globally possible:


	unknown_player -- the target player is unknown (code 1)

	unknown_server -- the target server is unknown (code 2)

	unkown_artifact -- the artifact could not be found (code 3)


### `status`

Type: GET

Request the player profile status for a given server, by name.

Request:

	?action=status&playername=PLAYERNAME&server_name=SERVER_NAME

Response:

	player:
		banned : {true|false}
		token : <token>

### `ban`

Type: POST
Body: reason string

Ban a player, requires a server token for the target server. The reason string is optional

Request:

	?action=ban&playername=PLAYERNAME&stoken=SERVER_TOKEN

Response:

	result: 0 or 1

### `unban`

Type: POST
Body: reason string

Unban a player, requires a server token for the target server. The reason string is optional.

Request:

	?action=unban&playername=PLAYERNAME&stoken=SERVER_TOKEN

Response:

	result : 0 or 1

### `store`

* Type: POST
* Body: the data to store

Store arbitrary data - for example, schem serialization.

Data can either be stored against the server, or against a player on the server.

Request:

	?action=store&key=STORE_KEY&stoken=SERVER_TOKEN
	?action=store&key=STORE_KEY&stoken=SERVER_TOKEN&playername=PLAYER_NAME

Response:

	result : 0 or 1

### `retrieve`

Type: GET

Retrieve arbitrary data in base64. It is up to the server to know whether the decoded data needs deserializing or not.

Request:

	?action=retrieve&key=STORE_KEY&stoken=SERVER_TOKEN
	?action=retrieve&key=STORE_KEY&stoken=SERVER_TOKEN&playername=PLAYER_NAME

Response:

	result: 0 or 1
	message: <base64 data>
