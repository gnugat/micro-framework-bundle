# How to contribute

Everybody should be able to help. Here's how you can make this project more
awesome:

1. [Fork it](https://github.com/gnugat/micro-framework-bundle/fork_select)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Your work will then be reviewed as soon as possible (suggestions about some
changes, improvements or alternatives may be given).

Here's some tips to make you the best contributor ever:

* [Tests](#tests)
* [Keeping your fork up-to-date](#keeping-your-fork-up-to-date)

## Tests

Tests can be run using the following script:

    ./bin/test.sh

It simply updates composer dependencies (with an optimized autoloading) and then
run the PHPUnit test suite.

## Keeping your fork up-to-date

To keep your fork up-to-date, you should track the upstream (original) one
using the following command:

    git remote add upstream https://github.com/gnugat/micro-framework-bundle.git

Then get the upstream changes:

    git checkout main
    git pull --rebase origin main
    git pull --rebase upstream main
    git checkout <your-branch>
    git rebase main

Finally, publish your changes:

    git push -f origin <your-branch>

Your pull request will be automatically updated.
