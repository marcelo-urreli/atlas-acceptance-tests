Feature: Search 

  Scenario: Atlas smoke test
    Given I am on "http://olx.pl"
    Then the response should contain "R3NDR"

  Scenario: Search for items using keyword
    Given I am on "http://olx.pl"
    When I fill in "iPhone 5" for "headerSearch"
    And the response should contain "iPhone"
    
  Scenario: Categories Browsing
    Given I am on "http://olx.pl/"
    When I follow "cat-5"
    When I follow "cat-84"
    Then the url should be "http://olx.pl/motoryzacja/samochody/"
    And the title should be "Samochody osobowe, używane auta na sprzedaż Ogłoszenia OLX.pl (dawniej Tablica.pl)"
    And the response status code should be 200