# Artifacts

Artifacts are data items that are stored in the database, and in some cases on the filesystem.

Artifacts can be used by servers to store player information, or by websites to store user information.

Artifacts have an identifying key in the context of a player. Two players can have different data under a same key.

## Types

Two types of artifacts are defined; whether they are used by the site is at the site designer's discretion.

### Text

Textual data - literally text, or small serialized data liek inventories, could be stored in such artifacts.

### File

A file that can be made available for download; for example images, or large serialized data like schematics.

## Access

Each artifact has a visibility mode. The default mode is Public.

### Public

Anybody visiting a player's page sees the artifacts

### Private

Only the owner can see the artifacts

## Protection

Artifacts can be editable or non-editable. The default proection is Non-editable.

## Actions

* Mark as public, internal, or private
* Modify editable artifacts
