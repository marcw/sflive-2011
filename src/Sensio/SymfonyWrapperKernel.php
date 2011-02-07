<?php

namespace Sensio;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * SymfonyWrapperKernel
 */
class SymfonyWrapperKernel implements HttpKernelInterface
{
    protected $application;
    protected $projectRoot;
    protected $environment;
    protected $debug;

    public function __construct($projectRoot, $application, $environment = 'dev', $debug = true)
    {
      $this->application = $application;
      $this->projectRoot = $projectRoot;
      $this->environment = $environment;
      $this->debug       = $debug;
    }

  /**
   * handle
   *
   * @param Request $request
   * @param mixed $type
   * @param boolean $raw
   * @return Response
   */
  public function handle(Request $request, $type = self::MASTER_REQUEST, $raw = false)
  {
    $this->lastRequest = $request;

    $request->overrideGlobals();
    $context = $this->getContext();

    $context->dispatch();

    $response = $context->getResponse();

    ob_start();
    $response->sendContent();
    $content = ob_get_clean();

    $response = new Response($content, $response->getStatusCode(), $response->getHttpHeaders());
    $response->headers->set('Surrogate-Control', 'content="ESI/1.0"');

    return $response;
  }

  /**
   * isDebug
   *
   * @return boolean
   */
  public function isDebug()
  {
    return $this->debug;
  }

  /**
   * Create the symfony1 context and fix the reentrance issues
   *
   * @return sfContext
   */
  protected function getContext()
  {
    require_once $this->projectRoot.'/config/ProjectConfiguration.class.php';

    $configuration = \ProjectConfiguration::getApplicationConfiguration($this->application, $this->environment, $this->debug);

    \sfConfig::set('sf_rendering_filter', array('slNoRenderingFilter', null));

    \sfException::clearLastException();

    $this->context = \sfContext::createInstance($configuration);

    return $this->context;
  }
}
