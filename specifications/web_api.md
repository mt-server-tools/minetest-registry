# Web API

A simple barebones API for querying a player profile, banning, unbanning, and storing arbitrary data.

## Format

The result data should be returned as JSON

	{
		"result" : { // Required
			"message" = message, // Optional
			"code" : result_code // 0 for success
		},

		"player" : { // for status for example
			"banned" : <boolean>,
			"token" : tokendata
		}
	}

## Calls

We can call a registry with the following commands and data; errors globally possible:


	unknown_player -- the target player is unknown (code 1)

	unknown_server -- the target server is unknown (code 2)


### `status`

Request the player profile status for a given server, by name.

Request:

	?action=status&playername=PLAYERNAME&server_name=SERVER_NAME

Response:

	player:
		banned : {true|false}
		token : <token>

### `ban`

Ban a player, requires a server token for the target server.

Request:

	?action=ban&playername=PLAYERNAME&stoken=SERVER_TOKEN

Response:

	result: 0 or 1

### `unban`

Unban a player, requires a server token for the target server.

Request:

	?action=unban&playername=PLAYERNAME&stoken=SERVER_TOKEN

Response:

	result : 0 or 1

### `store`

Store arbitrary data - for example, schem serialization.

Request:

	?action=store&key=STORE_KEY&data=STORE_DATA&stoken=SERVER_TOKEN

Response:

	result : 0 or 1

