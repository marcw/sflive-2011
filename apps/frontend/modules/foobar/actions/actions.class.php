<?php

/**
 * foobar actions.
 */
class foobarActions extends sfActions
{
  public function executeFirstFragment(sfWebRequest $request)
  {
    $this->getResponse()->setHttpHeader('Cache-Control', 's-maxage=3600, public');
  }

  public function executeSecondFragment(sfWebRequest $request)
  {
    $this->getResponse()->setHttpHeader('Cache-Control', 's-maxage=30, public');
  }

  public function executeThirdFragment(sfWebRequest $request)
  {
    $this->getResponse()->setHttpHeader('Cache-Control', 's-maxage=120, public');
  }
}
