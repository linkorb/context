Context
=======

Context is a library + toolkit to manipulate extractions of larger databases for conversion, transformation and presentation.

## Definitions

* **Context**: A Context is like a small in-memory database that can be traversed as a graph.
it contains one or more Tables. It should not contain an entire copy of a traditional database, instead it is designed to only contain a cohesive set of data about one particular object (i.e. a customer with all of it's data, a business with all of it's people, processes, policies, etc, or a project with all of it's cards, milestones and stakeholders).

* **Table**: Analogue to a database table, it contains one or more columns, and a RecordSet containing the actual data

* **Column**: Analogue to a database column, it describes the contents of the data. A regular (literal) column defines types (int, string, date, etc), requirements (required, allow null, etc) and textual description. You can also add special columns that can be used to reference other records based on a key. This allows you to create 1-to-n and n-to-1 references.

* **RecordSet**: an array of Records. There can be multiple implementations of a recordset interface. At the moment there's only the in-memory ArrayRecordSet implementation.

* **Record**: Star of the show: it comparse to a traditional database record, but contains rich functionality by binding it tightly to it's table and column definitions. An in-memory Record can be accessed both as an array (`$user['name']`) and as an object (`$user->name`) and supports many-to-1 relations to other tables (i.e. `$user->country->flagImageUrl`), as well as 1-to-many relations (i.e. `foreach($user->addresses as $address) echo $address->city`

## Use-cases

* Rapid applicationn development: You don't need to model objects (with getters/setters/etc) in order to work with them. Just define schema (in yaml) and load raw data (from json, yaml, arrays, etc for example) and you're ready to traverse the context and the records within it.
* Complex medical record mapping/conversion: Use a context to load all records related to a patient, then easily traverse it through it relations.
* Structured Documentation: Model information according to it's domain, then load it into a Contect and use templates to traverse the information.
* GraphQL datastore: A context is in essence a Graph. A context can therefor be used to generate a GraphQL server which can be used by other applications to easily query the context in a format of their choosing.
* Natural user interface/email/view generation: Simply define a context into a view, and loop over it with any template language such as twig, handlebars, mustache, etc. No further controller logic required.

## Naming conventions

Context does not really care about the naming used for tables, columns etc. But for consistency we recommend the following:

* Table names: `PascalCase`
* Column names: `camelCase`

This (as opposed to `snake-case` or `kebab_case`) will keep your code look natural when used in scripts and templates.

## License

MIT (see [LICENSE.md](LICENSE.md))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
