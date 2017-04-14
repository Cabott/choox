Feature: Create a new logo
  In order to have the collection of football logos grow through the users
  As a logged in football fan
  I need to be able to enrich the collection by adding a logo

  Background:
    Given I am logged in as "testUser"
    And I follow "menu.logo"
    And I follow "menu.logo.new"

  Scenario: Create a valid logo
    When I fill in the following:
    | logo_teamName    | Test team |
    | logo_teamCountry | MyCountry |
    | logo_teamHint    | A hint    |
    And I attach the file "original/testImageOriginal.png" to "logo_originalLogoFile_file"
    And I attach the file "altered/testImageAltered.jpg" to "logo_alteredLogoFile_file"
    And I press "logo_save"
    Then I should see "Your logo has been saved! Add another one!"

  Scenario: Not filling in required parameters
    When I press "logo_save"
    Then I should not see "Your logo has been saved! Add another one!"
    Given I fill in "logo_teamName" with "Test team"
    And I press "logo_save"
    Then I should not see "Your logo has been saved! Add another one!"
    Given I fill in "logo_teamCountry" with "MyCountry"
    And I press "logo_save"
    Then I should not see "Your logo has been saved! Add another one!"
    Given I fill in "logo_teamHint" with "A hint"
    And I press "logo_save"
    Then I should not see "Your logo has been saved! Add another one!"
    Given I attach the file "original/testImageOriginal.png" to "logo_originalLogoFile_file"
    And I press "logo_save"
    Then I should not see "Your logo has been saved! Add another one!"

  Scenario: Adding a logo for a team that already exists
    Given there is a logo for the team "Test team"
    When I fill in the following:
      | logo_teamName    | Test team |
      | logo_teamCountry | MyCountry |
      | logo_teamHint    | A hint    |
    And I attach the file "original/testImageOriginal.png" to "logo_originalLogoFile_file"
    And I attach the file "altered/testImageAltered.jpg" to "logo_alteredLogoFile_file"
    And I press "logo_save"
    Then I should see "This value is already used" in the "#logo > div.form-group.has-error > ul > li" element
    And I should not see "Your logo has been saved! Add another one!"
