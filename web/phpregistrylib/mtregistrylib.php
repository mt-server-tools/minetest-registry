<?php

class RegistryDbConnection {
	private $connection = null;
	
	public function __construct($hostname, $database, $password) {
		// Open a connection and assign in $connection
	}

	private function query($querystring) {
		// run a query and return the cursor
	}

	// ==============
	// Server manipulation

	public setServerInfo($servername, $serveraddress, $description, $owner) {
		// creates if not exists, updates if exists
	}

	public getServerToken($servername) {}

	public getServerInfo($servername) {}

	// ===============
	// Player manipulation

	// create player if not exists
	public setPlayerInfo($playername, $email, $password) {}

	// Confirm the player has validated their email address
	public confirmPlayer($playername) {}

	/**
	 * $login :  either an email or a playername
	 * $password : the plaintext password
	 */
	public checkPlayerLogin($login, $password) {
		// Note - the password and the email should both be salted with the playername
	}

	// =======================
	// Session manipulation

	/**
	 * Get player session info on the given server.
	 *
	 * Arguments
	 * $playername : the name of the player
	 * $servername : the name of the server
	 *
	 * Returns
	 * A player status object, indicating whether the player was found
	 */
	public getPlayerSession($servername, $playername) {
	}

	/**
	 * Whether the player was banned on this server
	 * 
	 * Returns
	 * boolean, true if player is banned, false if player is not banned or not known on the server
	 */
	public isBanned($servername, $playername) {}

	/**
	 * Ban a player
	 *
	 * Returns
	 * true if newly banned
	 * false if was already banned, or not yet known on the server
	 */
	public banPlayer($servername, $playername) {}

	/**
	 * Unban a player
	 *
	 * Returns
	 * true if newly unbanned
	 * false if was not yet banned, or not yet known on the server
	 */
	public banPlayer($servername, $playername) {}

	// =====================
	// Artifact maniipulation

	/**
	 * Set artifact data for player.
	 */
	public storePlayerArtifact($playername, $servername, $artifact_key, $artifact_title, $artifact_data) {
		// note, it is at this point that we base64-encode the data
	}

	public getPlayerArtifact($playername, $artifact_key) {
		// returns the artifact data as raw data - base64 decoding must be done
	}

	public storeServerArtifact($servername, $artifact_key, $artifact_title, $artifact_data) {}

	public getServerArtifact($servername, $artifact_key) {}
}

?>
