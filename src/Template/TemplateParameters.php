<?php
/*
 * This file is part of the Austral Website Bundle package.
 *
 * (c) Austral <support@austral.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Template;

/**
 * Austral Template Parameters.
 * @author Matthieu Beurel <matthieu@austral.dev>
 */
class TemplateParameters
{

  /**
   * @var array
   */
  protected array $parameters = array();

  public function __construct()
  {
  }

  /**
   * @return array
   */
  public function __serialize()
  {
    return array_merge($this->getParameters(), array());
  }

  /**
   * @param string $key
   * @param $value
   * @param bool $merge
   *
   * @return $this
   */
  public function addParameters(string $key, $value, bool $merge = false): self
  {
    if($merge && array_key_exists($key, $this->parameters))
    {
      $this->parameters[$key] = array_merge($this->parameters[$key], $value);
    }
    else
    {
      $this->parameters[$key] = $value;
    }
    return $this;
  }

  /**
   * @param string $key
   *
   * @return $this
   */
  public function removeParameters(string $key): self
  {
    if(array_key_exists($key, $this->parameters))
    {
      unset($this->parameters[$key]);
    }
    return $this;
  }

  /**
   * Get parameters
   *
   * @param string $key
   *
   * @return bool
   */
  public function hasParameter(string $key): bool
  {
    return array_key_exists($key, $this->parameters);
  }

  /**
   * Get parameters
   * @return array
   */
  public function getParameters(): array
  {
    return $this->parameters;
  }

  /**
   * Get parameters
   *
   * @param string $key
   * @param mixed $default
   *
   * @return mixed
   */
  public function getParameter(string $key, mixed $default = null): mixed
  {
    return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
  }

  /**
   * @param array $parameters
   *
   * @return $this
   */
  public function setParameters(array $parameters): self
  {
    $this->parameters = $parameters;
    return $this;
  }

}