<?php

/**
 * slNoRenderingFilter
 */
class slNoRenderingFilter extends sfFilter
{
  public function execute($filterChain)
  {
    $filterChain->execute();
  }
}
