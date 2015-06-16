<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param   array   $parameters     context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $default    = array('subcontext' => array());
        $parameters = array_merge($default, $parameters);

        foreach($parameters['subcontext'] as $name => $p) {
            $rClass = new ReflectionClass($name);
            $this->useContext($name, $rClass->newInstanceArgs(array(is_null($p) ? array() : $p)));
        }
    }

    /**
     * @Then /^I should get:$/
     */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string) $string !== $this->getMainContext()->output) {
            throw new Exception(
                "Actual output is:\n" . $this->getMainContext()->output
            );
        }
    }

     /**
     * @Given /^I wait for (\d+) seconds$/
     */
    public function iWaitForSeconds($seconds)
    {
        sleep($seconds);
    }
}
