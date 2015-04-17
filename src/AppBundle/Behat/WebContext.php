<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/02/15
 * Time: 20:05.
 */

namespace AppBundle\Behat;

use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class WebContext extends DefaultContext
{
    /**
     * @When I follow :button near :link
     */
    public function iClickNear($button, $value)
    {
        $tr = $this->assertSession()->elementExists('css', sprintf('.card:contains("%s")', $value));

        $locator = sprintf('a:contains("%s")', $button);

        if ($tr->has('css', $locator)) {
            $tr->find('css', $locator)->press();
        } else {
            $tr->clickLink($button);
        }
    }
}
