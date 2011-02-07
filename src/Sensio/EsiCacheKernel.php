<?php

namespace Sensio;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\HttpKernel\HttpCache\Store;

/**
 * EsiCacheKernel
 */
class EsiCacheKernel extends HttpCache
{
  /**
   * __construct
   *
   * @param HttpKernelInterface $kernel
   * @param string $project_root
   */
  public function __construct(HttpKernelInterface $kernel, $project_root)
  {
    $this->kernel = $kernel;
    $this->esi    = new Esi();
    $this->store  = new Store($project_root.'/cache/http_cache');

    parent::__construct($this->kernel, $this->store, $this->esi, array('debug' => $this->isDebug()));
  }

  /**
   * This method returns the debug state of decorated kernel.
   *
   * @return boolean
   */
  protected function isDebug()
  {
    return $this->kernel->isDebug();
  }
}
