<?php

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;

/**
 * Features context.
 */
class WebContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param   array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }


    /**
     * @Given /^(.*) without redirection$/
     */
    public function theRedirectionsAreIntercepted($step)
    {
        $this->getSession()->getDriver()->getClient()->followRedirects(false);

        return new Step\Given($step);
    }

    /**
     * @When /^I follow the redirection$/
     * @Then /^I should be redirected$/
     */
    public function iFollowTheRedirection()
    {
        $client = $this->getSession()->getDriver()->getClient();
        $client->followRedirects(true);
        $client->followRedirect();
    }

    /**
     * @Then /^the url should be "([^"]*)"$/
     */
    public function theUrlShouldBe($expected)
    {
        $actual = $this->getSession()->getCurrentUrl();
        if ((string) $expected !== $actual) {
            throw new Exception(sprintf(
                'Current url "%s" does not match "%s"',
                $actual,
                $expected
            ));
        }
    }

    /**
     * @Then /^the title should be "([^"]*)"$/
     */
    public function theTitleShouldBe($expected)
    {
        $session = $this->getSession();
        $page    = $session->getPage();
        $actual  = $page->find('css', 'title')->getText();

        if ((string) $expected !== $actual) {
            throw new Exception(sprintf(
                'Current title "%s" does not match "%s"',
                $actual,
                $expected
            ));
        }
    }

    /**
     * @Then /^the meta "([^"]*)" should be "([^"]*)"$/
     */
    public function theMetaShouldBe($name, $expected)
    {
        $actual  = null;
        $session = $this->getSession();
        $page    = $session->getPage();
        $el      = $page->find('css', "meta[name=$name]");

        if ($el)
            $actual  = $el->getAttribute('content');

        if ((string) $expected !== $actual) {
            throw new Exception(sprintf(
                'Current "%s" does not match "%s"',
                $actual,
                $expected
            ));
        }
    }


    /**
     * @Then /^the header "([^"]*)" should be "([^"]*)"$/
     */
    public function theHeaderShouldBe($name, $expected)
    {
        $name    = strtolower($name);
        $session = $this->getSession();
        $headers = array_change_key_case($session->getResponseHeaders());
        $actual  = $headers[$name][0];

        if (!isset($headers[$name])) {
            throw new Exception(sprintf('Header "%s" is not set', $name));
        }

        if ((string) $expected !== $actual) {
            throw new Exception(sprintf(
                'Header "%s" does not match. Current:"%s" Expected:"%s"',
                $name,
                $actual,
                $expected
            ));
        }
    }

    /**
     * @Then /^the related ads module should have a link to "([^"]*)" with the anchor "([^"]*)"$/
     */
    public function theRelatedAdsModuleShouldHaveALink($href, $anchor)
    {
        $actual  = null;
        $session = $this->getSession();
        $page    = $session->getPage();
        $el      = $page->find('css', "a[href='$href']");

        if ($el)
            $actual  = $el->getText();

        if ((string) $anchor !== $actual) {
            throw new Exception(sprintf(
                'Current "%s" does not match "%s"',
                $actual,
                $anchor
            ));
        }
    }

    /**
     * @Given /^the popular search module should have a link to "([^"]*)" with the anchor "([^"]*)"$/
     */
    public function thePopularSearchModuleShouldHaveALinkToWithTheAnchor($href, $anchor)
    {
     $actual  = null;
        $session = $this->getSession();
        $page    = $session->getPage();
        $el      = $page->find('css', "a[href='$href']");

        if ($el)
            $actual  = $el->getText();

        if ((string) $anchor !== $actual) {
            throw new Exception(sprintf(
                'Current "%s" does not match "%s"',
                $actual,
                $anchor
            ));
        }
    }


    /**
     * @Given /^the seo popular search module should have a link to "([^"]*)" with the anchor "([^"]*)"$/
     */
    public function theSeoPopularSearchModuleShouldHaveALinkToWithTheAnchor($href, $anchor)
    {

        $actual  = null;
        $session = $this->getSession();
        $page    = $session->getPage();
        $el      = $page->find('css', "a[href='$href']");

        if ($el)
            $actual  = $el->getText();

        if ((string) $anchor !== $actual) {
            throw new Exception(sprintf(
                'Current "%s" does not match "%s"',
                $actual,
                $anchor
            ));
        }
    }

}
