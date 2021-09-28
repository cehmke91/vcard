## Running the application

### Requirements

 - php7.4

`cd` into this directory and run `php test.php` command.
It will output an HTML string representing the vcard in the file.
The filepath can be changed in the settings section at the top of the script.
The path is relative to the project path.

Constructor property promotion has not been used as it is part of PHP8.0 and
the task asked for 7.x syntax.

## Implementation

Script uses a parser to produce vCard objects, these are then transformed for output.
The idea behind this is that the output can then be changed to suit needs without needing
to rewrite anything in the Parser. For example a JsonTransformer could receive the objects
and transform them into JSON instead of HTML if needed.

The Parser makes use of several other objects, which are provided through dependency injection.
This makes these easier to switch out if needed. For example the Interpretor can be switched for
one which interprets v3 or v5 of the spec without needing to change the parser.

A factory is used to construct vCard objects from the information read out of the files.
This is done to remove the responsibility of objects to handle their own creation.

For the most part these are kept simple, their purpose more being to showcase the idea than
to provide a fully fleshed out implementation.

Some examples of interfaces can be found, the Transformer and FileHander both implement an interface.
Examples of Inheritance can be found in the Models.

Custom Exceptions are given, this is done so that the Exception itself is telling of where the error
occurs rather than relying on the messages. Handling of these exceptions has been left bare, likewise
they are mostly present to showcase the principle.

Likewise the full spec has not been implemented for the sake of simplicity and scope.
Some more information on this can be found below.

## vCard Properties

For the purpose of scope I've elected to only implement the properties that are present
on the given example. Where there may be required properties outside of these properties
they will be left out regardless.

For the sake of simplicity where cardinality in the spec is * and the example is simply a
string, the properties have been updated to a cardinality of *1 instead.

ORG has been updated so that it will instead be flattened in the order properties are presented.

## Malformed inputs.

PHOTO in the example given is incorrectly formatted. Used examples are corrected to
comply with the format in the RFC. To prevent scope creep I have decided to not handle
incorrect formatting at this point. The interpreter could be made smarter in order to
detect malformed lines. I see 3 appraoches to handling the incorrect format.

1. GIGO (Garbage-In Garbage-Out):
    We just let it be, the output is garbage, it is in this case up to the user to
    spot and correct the mistake.
2. Hard Fail:
    We throw an exception and let the program die. The exception should be clear as
    to where the error was, allowing the user to correct it.
3. Soft Fail:
    Just ignore the line and don't parse it, Leaving the result empty.
    This will also fall back on the failure strategy of the rest of the system,
    this could for example cause a hard fail should a required property be malformed.
    In the case of unrequired properties they would simply not be in the end result.

Which strategy to choose is dependent on where the program is used and on the technical
level of the user.


ADR was also incorrectly implemented. v4 of the spec indicated that the first 2 inputs should remain blank.
It has likewise been corrected.

## No composer?

Looking at the copernica API documentation it's clear that composer is not used.
For this reason I've elected to not use composer for this assignment, instead opting
manually 'autoload' classes. This can be found in the BOOT section under test.php.