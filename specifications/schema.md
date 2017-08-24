# Backend schema

I want to keep the schema simple - as such, I am just trying to solve a general case. The artifacts system is used for setting server and player specific infromation, which can be used by any application leveraging the library.

## Notes

**Servers**

We track a server, it should have an owner.

Server should have a token by which the game mod will be able to authenticate.

The description is for display purposes. The name is a shortname that allows querying against anonymously.

A special server id `0` is reserved for the web server.

**Players**

Each player has an account ; the email is not stored - instead it is hashed, salted with the playername. Registries are likely not going to be administerd by professionals with security in mind, so we do not want it to become an easy trove of proven identities, thewhich could be associated with players, whose age groups can sometimes be inferred whilst lurking in the chat channel.

Passwords are obviously hashed; the choice here is a SHA-512 which should be sufficient for our purposes and sufficiently future-proof. The hash should be salted with the playername.

**Registrations**

Since the email is kept in a hash salted by the playername, we need a separate store of unsalted email hashes against unsalted player name hashes.

This prevents using an email to lookup a playername should a data dump be obtained.

**Sessions**

A session associates a player with a server, and on this unique association we can associate the ban status.

**Artifacts**

An artifact is simply some arbitrary data stored on the server. Before storage, even in-database, it is base64-encoded. Wonder if this can be implemented with a constraint at DB level ...?

Artifacts can be associated with servers, or a server+artifact pair. These can be data schematics, play times, achievements - anything. A display message can be stored as the artifact's "meta-info", to be separate from the payload.

Web applications built to leverage the registry can use this data as they wish, for example for storing an extended bio, or an avatar - etc.

Only the server that set the artifact initially can alter the artifact.

## Objects

	servers
	----------------
	int server_id PRIMARY KEY
	char(32) server_token -- md5
	varchar(32) INDEXED server_name
	varchar(32) server_desc
	varchar(100) server_domain
	int owner -- a player


	players
	----------------
	int player_id PRIMARY KEY
	varchar(32) playername INDEXED -- actual player name
	char(128) h_pass -- sha512
	char(32) h_mail -- md5

	
	registrations
	----------------
	char(32) h_mail -- md5
	char(32) h_playername -- md5
	bool confirmed
	

	sessions
	----------------
	int player_id FOREIGN KEY
	int server_id FOREIGN KEY
	bool banned


	artifacts
	----------------
	int artifact_id PRIMARY KEY
	int player_id
	int server_id
	varchar(64) app_key INDEXED -- a way for the server to recall the data if needed
	varchar(128) item_name -- for display
	bool isfile -- whether the data is literal, or a path; set by library
	varchar(512) data -- literal data, or path to file
	bool editable -- whether the player is allowed to edit this via the website
	int flags -- an additional meta data for arbitrary use by the arifact creator
