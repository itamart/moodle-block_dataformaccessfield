@block @block_dataformaccessfield @set_dataform @dataformrule
Feature: Block dataform access field

    @javascript
    Scenario: Manage access rule
        Given I run dataform scenario "access rule management" with:
            | ruletype | field |
