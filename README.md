# Database Interface Layer of Tutorial System

## Description 

Database Interface Layer is governing input and output process of database communication from any other micro services. In this abstraction layer, this repository will provide the API for communication with the following tables: 

- content-category (master table)
- content-metadata (transactional table with one of the foreign key comes from content-category table)

As the result of this service, the Input and Output query into content-category and content-metadata tables will be provided as rest APIs.


![RESTAPI.jpg](images/RESTAPI.jpg)

## API END POINT
* http://localhost/v1

## Table Structure endpoints
| URL                            | Method | INFO              | Fields  |
| ------------------------------ | ------ | ----------------- | ------- |
| `content/metadata`             | GET    | Get All Data      | -       |
| `content/metadata/store`       | POST   | Save Data         | -       |
| `content/metadata/{id}`        | GET    | Get Data by ID    | -       |
| `content/metadata/search`      | POST   | Search Data Query | -       |
| `content/metadata/update/{id}` | POST   | Update Data by ID | -       |
| `content/metadata/delete/{id}` | POST   | Delete Data by ID | -       |
| `content/category`             | GET    | Get All Data      | -       |
| `content/category/store`       | POST   | Save Data         | -       |
| `content/category/{id}`        | GET    | Get Data by ID    | -       |
| `content/category/search`      | POST   | Search Data Query | `title` |
| `content/category/update/{id}` | POST   | Update Data by ID | -       |
| `content/category/delete/{id}` | POST   | Delete Data by ID | -       |


## Example screen shots of API invocations

![RESTAPI.jpg](images/Selection_01283.png)

![RESTAPI.jpg](images/Selection_01284.png)

![RESTAPI.jpg](images/Selection_01285.png)

![RESTAPI.jpg](images/Selection_01286.png)

![RESTAPI.jpg](images/Selection_01287.png)

![RESTAPI.jpg](images/Selection_01290.png)

![RESTAPI.jpg](images/Selection_01291.png)


## How to commit

When committing, precommit hook been called and expect tests and linting be passed first

### Commit message [Conventional Commits](https://conventionalcommits.org/).

The commit message should be structured as follows:

---

```bash
<squad abbreviation-ticket number> <type>(<scope>):  <description>
<BLANK LINE>
[optional body]
<BLANK LINE>
[optional footer]
```

---

## Examples

### Commit message with description, scope and breaking change in body

```bash
CM-21 feat(dbid): allow provided config object to extend other configs

CM-22 BREAKING CHANGE(dbid): redirect old API request service page to new version
```

### Revert

If the commit reverts a previous commit, it should begin with `revert:`, followed by the header of the reverted commit. In the body it should say: `This reverts commit <hash>.`, where the hash is the SHA of the commit being reverted.

### Type

Must be one of the following:

| type            | usage                                                                                                                                                                 |
| :-------------- | :-------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| fix             | A bug fix (this correlates with [PATCH](http://semver.org/#summary) in semantic versioning).                                                                          |
| feat            | A new feature (this correlates with [MINOR](http://semver.org/#summary) in semantic versioning).                                                                      |
| BREAKING CHANGE | introduces a breaking API change (correlating with [MAJOR](http://semver.org/#summary) in semantic versioning). A breaking change can be part of commits of any type. |
| chore           | bau taks                                                                                                                                                              |
| build           | Changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm, webpack)                                                          |
| ci              | Changes to our CI configuration files and scripts (example scopes: Travis, Circle, BrowserStack, SauceLabs)                                                           |
| docs            | Documentation only changes                                                                                                                                            |
| perf            | A code change that improves performance                                                                                                                               |
| refactor        | A code change that neither fixes a bug nor adds a feature                                                                                                             |
| style           | Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)                                                                |
| test            | Adding missing tests or correcting existing tests                                                                                                                     |

### Scope

The scope should be the name of the component package affected (as perceived by the person reading the changelog generated from commit messages.

The following is the list of supported scopes:

| Short Code | Components                                      |
| :--------- | :---------------------------------------------- |
| dbid       | Database Interface Layer                        |
| test       | Test automation                                 |
| doc        | Documentation                                   |
... keep adding above list
