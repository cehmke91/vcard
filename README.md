# copernica-test
Code challenge completed for Copernica

## Your mission
vCard, also known as VCF (Virtual Contact File), is a file format standard for electronic business
cards. vCards are often attached to e-mail messages when sharing contact details. Your task is to
create your very own vCard parser. This parser needs to be able to process the latest standard
(vCard 4.0), which is built upon the RFC 6350 standard. Don't worry, for the purpose of this
assignment you don't need to implement the complete RFC

## Instructions
 - The primary objective of the assignment is to create a parser that can read both single and multiple vCards from a single file.
 - You are expected to implement this assignment using an Object-Oriented programming (OOP) approach. It is not allowed to use a third party library and just build a wrapper around it. You can only use built-in PHP features.
 - You are free in naming your methods and classes. The assignment you submit needs to have at least a test.php file that can be executed to see your parser in action.

## Bonus
 - Clean code!
 - Document your code
 - Knowledge of modern best practices/coding patterns.
 - Use PHP 7 syntax where possible
 - Export vCard to jCard

## Example vCard 4.0
```
BEGIN:VCARD
VERSION:4.0
N:Doe;John;;Mr;
FN:Mr John Doe
ORG:Copernica BV
TITLE:Software Engineer
PHOTO;MEDIATYPE=image/gif:http://www.example.com/dir_photos/my_photo.gif
ADR:;De Ruijterkade 112;;Amsterdam;;1011AB;Nederland
EMAIL:jobs@copernica.com
REV:20080424T195243Z
END:VCARD
```

## Some additional notes

Some additional notes and thoughts can be found in [NOTES.md](NOTES.md)
