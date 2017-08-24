# Web Page Interace

This is a light specification for web pages in the core implementation of the registry.

## Home page `/`

The home page displays a search box where servers and players can be searched for

## Login `/login`

The login page simply challenges for a playername, and a password.

Failed authentication returns the user to the login page

### Registration and Reset `/register`

The registration page requires

* playername
* email for confirmation

On submitting, an email with a password reset link is sent.

The registration page also serves as the password reset page. For an existing player, the playername supplied must match the associated email.

### Password reset page `/password`

Confirmation links lead to the password reset page.

At this point, the user can reset their password.

## Player Page `/p/<playername>`

### Public

The public view of a player page shows

* their playername
* their bio
* their custom avatar if any
* the servers they own
* the public artifacts on their account

### Authenticated : Others

An authenticated user can see another player's page, as well as

* the servers they play on and their ban status
* their shared artifacts

### Authenticated : Owner

The authenticated view allows its owner to see the public details, as well as

* their nonce.
* their private artifacts

The nonce is renewed by the server regularly, every minute, and is specific to them.

They can also edit the page.

### Authenticated : Edit `/edit`

The edit page shows a player's own details. All users accessing the edit page are shown their own details.

The edit page allows users to

* change their password
* change their bio
* change their email
* upload a new avatar
* manage their artifacts

## Server `/s/<servername>`

### Public, Authenticated : Others

The public view of the server shows

* the description
* connection details of the server
* the logo
* the header image
* the owner
* the public artifacts

### Authenticated : Owner

The owner of the page can see

* the private artifacts
* list of banned players
* edit button

### Authenticated : Edit `/s/<servername>/edit`

The owner of the page can access the edit page; non-owners are re-directed to the Public view

The owner can

* set a new server token (can be generated as a random string)
* a new owner (to pass on ownership - they will lose ownership if they do this)
* set a new logo, header image
* update description
* update connection details
* manage artifacts
